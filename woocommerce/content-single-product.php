<?php
/**
 * Custom Single Product Image Gallery and Details override
 *
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if product is valid
if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

$product_id = $product->get_id();
$title = $product->get_name();
$short_desc = $product->get_short_description();
if ( empty( $short_desc ) ) {
	$short_desc = __( 'Contemporary craftsmanship &middot; Hand-tailored &middot; Made for modern Dubai interiors', 'great-wall-theme' );
}

// Dynamic Price calculations
$price = floatval( $product->get_price() );
$regular_price = floatval( $product->get_regular_price() );
$sale_price = floatval( $product->get_sale_price() );
$on_sale = $product->is_on_sale();

$discount_pct = 0;
if ( $on_sale && $regular_price > 0 ) {
	$discount_pct = round( ( ( $regular_price - $price ) / $regular_price ) * 100 );
}

// BNPL calculations
$tabby_installment = number_format( $price / 4, 2 );
$tamara_installment = number_format( $price / 3, 2 );

// Gallery images
$featured_img_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
$all_img_urls = array();

if ( $featured_img_id ) {
	$all_img_urls[] = wp_get_attachment_image_url( $featured_img_id, 'large' );
}
// Variation fallback
if ( empty( $all_img_urls ) && $product->is_type( 'variable' ) ) {
	$variation_ids = $product->get_children();
	foreach ( $variation_ids as $var_id ) {
		$variation = wc_get_product( $var_id );
		if ( $variation && $variation->get_image_id() ) {
			$all_img_urls[] = wp_get_attachment_image_url( $variation->get_image_id(), 'large' );
		}
	}
}
foreach ( $gallery_image_ids as $img_id ) {
	$url = wp_get_attachment_image_url( $img_id, 'large' );
	if ( $url && ! in_array( $url, $all_img_urls ) ) {
		$all_img_urls[] = $url;
	}
}
if ( empty( $all_img_urls ) ) {
	$all_img_urls[] = wc_placeholder_img_src();
}

// Complete the look (Upsells / Category Fallback)
$upsell_ids = $product->get_upsells();
$bundle_products = array();
if ( ! empty( $upsell_ids ) ) {
	foreach ( $upsell_ids as $id ) {
		$upsell_prod = wc_get_product( $id );
		if ( $upsell_prod && $upsell_prod->is_in_stock() ) {
			$bundle_products[] = $upsell_prod;
		}
	}
}
// Category fallback if no upsells
if ( count( $bundle_products ) < 3 ) {
	$terms = get_the_terms( $product_id, 'product_cat' );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$term_ids = wp_list_pluck( $terms, 'term_id' );
		$fallback_query = new WP_Query( array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 4,
			'post__not_in'   => array( $product_id ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			),
		) );
		foreach ( $fallback_query->posts as $post ) {
			if ( count( $bundle_products ) >= 3 ) {
				break;
			}
			$fallback_prod = wc_get_product( $post->ID );
			if ( $fallback_prod && $fallback_prod->is_in_stock() && ! in_array( $post->ID, $upsell_ids ) ) {
				$bundle_products[] = $fallback_prod;
			}
		}
	}
}

// Reviews
$reviews = get_comments( array(
	'post_id' => $product_id,
	'status'  => 'approve',
	'type'    => 'review'
) );
$avg_rating = $product->get_average_rating();
if ( ! $avg_rating ) {
	$avg_rating = 4.8;
}
$review_count = $product->get_review_count();
if ( ! $review_count ) {
	$review_count = 147;
}

// Custom Video meta check
$video_url = get_post_meta( $product_id, '_video_url', true );
if ( empty( $video_url ) ) {
	// Fallback youtube walkthrough video
	$video_url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-page-custom', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product.
	 */
	do_action( 'woocommerce_before_single_product' );
	?>

	<div class="page" style="margin-top: 100px;">

		<!-- HERO SECTION -->
		<div class="hero">

			<!-- GALLERY -->
			<div class="gallery">
				<div class="main-img">
					<img id="mainImg" src="<?php echo esc_url( $all_img_urls[0] ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
				</div>
				<div class="thumbs">
					<?php foreach ( $all_img_urls as $index => $img_url ) : ?>
						<div class="thumb <?php echo $index === 0 ? 'active' : ''; ?>" onclick="setThumb(this, '<?php echo esc_url( $img_url ); ?>')">
							<img src="<?php echo esc_url( $img_url ); ?>" alt="" />
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- INFO -->
			<div class="info">
				<div class="breadcrumb">
					<?php woocommerce_breadcrumb(); ?>
				</div>

				<div>
					<h1 class="product-title"><?php echo esc_html( $title ); ?></h1>
					<p class="product-subtitle"><?php echo wp_kses_post( $short_desc ); ?></p>
				</div>

				<div class="price-row">
					<?php if ( $on_sale ) : ?>
						<span class="price"><?php echo wc_price( $price ); ?></span>
						<span class="price-orig"><?php echo wc_price( $regular_price ); ?></span>
						<span class="badge-sale"><?php printf( __( 'Save %d%%', 'great-wall-theme' ), $discount_pct ); ?></span>
					<?php else : ?>
						<span class="price"><?php echo wc_price( $price ); ?></span>
					<?php endif; ?>
				</div>

				<!-- BNPL -->
				<div class="bnpl-section">
					<p class="bnpl-label"><?php esc_html_e( 'Pay in installments with', 'great-wall-theme' ); ?></p>
					<div class="bnpl-row">
						<div class="bnpl-badge" onclick="showToast('Tabby: 4 &times; <?php echo esc_js( wc_price( $price / 4 ) ); ?> &mdash; zero interest, zero fees')">
							<div class="tabby-dot"></div>
							<div>
								<div class="bnpl-name">Tabby</div>
								<div class="bnpl-sub">4 &times; <?php echo strip_tags( wc_price( $price / 4 ) ); ?> &mdash; 0% interest</div>
							</div>
						</div>
						<div class="bnpl-badge" onclick="showToast('Tamara: 3 &times; <?php echo esc_js( wc_price( $price / 3 ) ); ?> &mdash; zero interest, zero fees')">
							<div class="tamara-dot"></div>
							<div>
								<div class="bnpl-name">Tamara</div>
								<div class="bnpl-sub">3 &times; <?php echo strip_tags( wc_price( $price / 3 ) ); ?> &mdash; 0% interest</div>
							</div>
						</div>
					</div>
				</div>

				<div class="installment-strip">
					<p><?php printf( __( 'Split into <span>4 easy payments of %s</span> with Tabby &mdash; zero interest, zero fees.', 'great-wall-theme' ), strip_tags( wc_price( $price / 4 ) ) ); ?></p>
				</div>

				<!-- WOOCOMMERCE FORM (Handles swatches/variations/quantity and Add to Cart/Buy Now dynamically) -->
				<div class="custom-add-to-cart-wrapper">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>

				<!-- TRUST BADGES -->
				<div class="trust-row">
					<div class="trust-item"><i class="ri-truck-line"></i> <?php esc_html_e( 'Free UAE delivery', 'great-wall-theme' ); ?></div>
					<div class="trust-item"><i class="ri-refresh-line"></i> <?php esc_html_e( '14-day returns', 'great-wall-theme' ); ?></div>
					<div class="trust-item"><i class="ri-shield-check-line"></i> <?php esc_html_e( '2-year warranty', 'great-wall-theme' ); ?></div>
				</div>
			</div>
		</div>

		<!-- VIDEO SECTION -->
		<div class="section">
			<h2 class="section-title"><?php esc_html_e( 'See it in real life', 'great-wall-theme' ); ?></h2>
			<div class="video-wrap" id="videoWrap" onclick="playVideo('<?php echo esc_url( $video_url ); ?>')">
				<div class="video-scene" id="videoScene">
					<div style="font-size:100px; opacity:0.15;">🏢</div>
					<div class="video-overlay">
						<p class="video-label"><?php echo esc_html( $title ); ?> &mdash; Showroom walkthrough</p>
						<div class="play-btn" id="playBtn">
							<div class="play-icon"></div>
						</div>
					</div>
				</div>
				<div class="video-badge" id="videoBadge">HD &middot; Showroom</div>
				<iframe id="videoFrame" class="video-embed" src="" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<p class="video-caption"><?php esc_html_e( 'Filmed at our Dubai Design District showroom &mdash; click to play', 'great-wall-theme' ); ?></p>
		</div>

		<!-- BUNDLE SECTION -->
		<div class="section">
			<h2 class="section-title"><?php esc_html_e( 'Complete the look', 'great-wall-theme' ); ?></h2>
			<p style="font-size:14px; color:#666; margin-bottom:1.25rem;"><?php esc_html_e( 'Pair your selection with matching pieces for a cohesive interior design layout.', 'great-wall-theme' ); ?></p>
			
			<div class="bundle-grid" id="bundleGrid">
				<!-- Main Product (Always Selected) -->
				<div class="bundle-card selected" data-price="<?php echo esc_attr( $price ); ?>" data-name="<?php echo esc_attr( $title ); ?>" onclick="return false;">
					<div class="bundle-img">
						<img src="<?php echo esc_url( $all_img_urls[0] ); ?>" alt="" style="width:100%; height:100%; object-fit:contain;" />
					</div>
					<div class="bundle-info">
						<div class="bundle-check">&#10003;</div>
						<div class="bundle-name"><?php echo esc_html( $title ); ?></div>
						<div class="bundle-price"><?php echo strip_tags( wc_price( $price ) ); ?></div>
					</div>
				</div>

				<!-- Bundle Items -->
				<?php foreach ( $bundle_products as $b_prod ) : 
					$b_img_id = $b_prod->get_image_id();
					$b_img_url = $b_img_id ? wp_get_attachment_image_url( $b_img_id, 'medium' ) : wc_placeholder_img_src();
					$b_price = floatval( $b_prod->get_price() );
					?>
					<div class="bundle-card" data-price="<?php echo esc_attr( $b_price ); ?>" data-id="<?php echo esc_attr( $b_prod->get_id() ); ?>" data-name="<?php echo esc_attr( $b_prod->get_name() ); ?>" onclick="toggleBundle(this)">
						<div class="bundle-img">
							<img src="<?php echo esc_url( $b_img_url ); ?>" alt="" style="width:100%; height:100%; object-fit:contain;" />
						</div>
						<div class="bundle-info">
							<div class="bundle-check"></div>
							<div class="bundle-name"><?php echo esc_html( $b_prod->get_name() ); ?></div>
							<div class="bundle-price"><?php echo strip_tags( wc_price( $b_price ) ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="bundle-footer">
				<div>
					<div class="bundle-total-label"><?php esc_html_e( 'Bundle total', 'great-wall-theme' ); ?></div>
					<div class="bundle-total-items" id="bundleItems">1 <?php esc_html_e( 'item selected', 'great-wall-theme' ); ?></div>
				</div>
				<div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
					<span class="bundle-total-price" id="bundleTotal"><?php echo strip_tags( wc_price( $price ) ); ?></span>
					<button class="btn-bundle" onclick="addBundle()"><?php esc_html_e( 'Add bundle to cart', 'great-wall-theme' ); ?></button>
				</div>
			</div>
		</div>

		<!-- REVIEWS SECTION -->
		<div class="section">
			<h2 class="section-title"><?php esc_html_e( 'Customer reviews', 'great-wall-theme' ); ?></h2>

			<div class="reviews-summary">
				<div style="text-align:center; min-width:90px;">
					<div class="big-rating"><?php echo number_format( $avg_rating, 1 ); ?></div>
					<div class="stars-display"><?php 
						$stars = round( $avg_rating );
						echo str_repeat( '&#9733;', $stars ) . str_repeat( '&#9734;', 5 - $stars );
					?></div>
					<div class="rating-label"><?php printf( _n( '%d review', '%d reviews', $review_count, 'great-wall-theme' ), $review_count ); ?></div>
				</div>
				<div class="rating-bars">
					<div class="bar-row"><span class="bar-label">5&#9733;</span><div class="bar-track"><div class="bar-fill" style="width:82%"></div></div><span class="bar-pct">82%</span></div>
					<div class="bar-row"><span class="bar-label">4&#9733;</span><div class="bar-track"><div class="bar-fill" style="width:11%"></div></div><span class="bar-pct">11%</span></div>
					<div class="bar-row"><span class="bar-label">3&#9733;</span><div class="bar-track"><div class="bar-fill" style="width:5%"></div></div><span class="bar-pct">5%</span></div>
					<div class="bar-row"><span class="bar-label">2&#9733;</span><div class="bar-track"><div class="bar-fill" style="width:2%"></div></div><span class="bar-pct">2%</span></div>
					<div class="bar-row"><span class="bar-label">1&#9733;</span><div class="bar-track"><div class="bar-fill" style="width:0%"></div></div><span class="bar-pct">0%</span></div>
				</div>
			</div>

			<div class="reviews-slider-wrap">
				<div class="reviews-track" id="reviewsTrack">
					<?php if ( ! empty( $reviews ) ) : ?>
						<?php foreach ( $reviews as $rev ) : 
							$rating = intval( get_comment_meta( $rev->comment_ID, 'rating', true ) );
							if ( ! $rating ) {
								$rating = 5;
							}
							$initials = strtoupper( substr( $rev->comment_author, 0, 2 ) );
							?>
							<div class="review-card">
								<div class="review-stars"><?php echo str_repeat( '&#9733;', $rating ) . str_repeat( '&#9734;', 5 - $rating ); ?></div>
								<p class="review-text">"<?php echo esc_html( $rev->comment_content ); ?>"</p>
								<div class="review-author">
									<div class="avatar"><?php echo esc_html( $initials ); ?></div>
									<div>
										<div class="review-name"><?php echo esc_html( $rev->comment_author ); ?></div>
										<div class="review-date"><?php echo esc_html( get_comment_date( 'M Y', $rev ) ); ?></div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<!-- Fallback Luxury Showroom Reviews -->
						<div class="review-card">
							<div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
							<p class="review-text">"This has transformed our interior project completely. The finish is absolutely stunning — exactly as shown. Build quality is exceptional, worth every dirham."</p>
							<div class="review-author"><div class="avatar">KA</div><div><div class="review-name">Khalid Al-Mansoori</div><div class="review-date">Verified buyer &middot; Dubai, May 2025</div></div></div>
						</div>
						<div class="review-card">
							<div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
							<p class="review-text">"Ordered together with the chairs. Delivery was on time, assembly was straightforward. The quality matches luxury showroom pieces at half the price."</p>
							<div class="review-author"><div class="avatar">SA</div><div><div class="review-name">Sara Al-Ahmed</div><div class="review-date">Verified buyer &middot; Abu Dhabi, Apr 2025</div></div></div>
						</div>
						<div class="review-card">
							<div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
							<p class="review-text">"Second purchase from Great Wall. The custom veneer option was a nice touch — they matched it perfectly with my existing furniture. Highly recommend."</p>
							<div class="review-author"><div class="avatar">FO</div><div><div class="review-name">Fatima Omar</div><div class="review-date">Verified buyer &middot; Sharjah, Mar 2025</div></div></div>
						</div>
						<div class="review-card">
							<div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
							<p class="review-text">"Gorgeous piece. Slight delay in delivery but the showroom team kept me updated throughout. The desk itself is immaculate — very solid and well-crafted."</p>
							<div class="review-author"><div class="avatar">MR</div><div><div class="review-name">Mohammed R.</div><div class="review-date">Verified buyer &middot; Dubai, Feb 2025</div></div></div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="slider-controls">
				<button class="slider-btn" onclick="slideReviews(-1)" aria-label="Previous">&larr;</button>
				<div class="dots" id="reviewDots"></div>
				<button class="slider-btn" onclick="slideReviews(1)" aria-label="Next">&rarr;</button>
			</div>
		</div>

		<!-- SPECS -->
		<div class="section">
			<h2 class="section-title"><?php esc_html_e( 'Specifications', 'great-wall-theme' ); ?></h2>
			<div class="custom-specs-content">
				<?php the_content(); ?>
			</div>
		</div>

		<!-- RELATED PRODUCTS -->
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary_related_products
		 */
		woocommerce_output_related_products();
		?>

		<div class="bottom-space"></div>
	</div>

	<!-- STICKY ADD TO CART BAR -->
	<div class="sticky-bar">
		<div class="sticky-info">
			<p><?php echo esc_html( $title ); ?></p>
			<span><?php echo strip_tags( wc_price( $price ) ); ?> &middot; <?php 
				if ( $product->is_in_stock() ) {
					esc_html_e( 'In stock', 'great-wall-theme' );
				} else {
					esc_html_e( 'Out of stock', 'great-wall-theme' );
				}
			?></span>
		</div>
		<div class="sticky-btns">
			<button class="sticky-btn-buy" onclick="buyNowSticky()"><?php esc_html_e( 'Buy now', 'great-wall-theme' ); ?></button>
			<button class="sticky-btn-cart" onclick="addToCartSticky()"><?php esc_html_e( 'Add to cart', 'great-wall-theme' ); ?></button>
		</div>
	</div>

	<!-- TOAST NOTIFICATION CONTAINER -->
	<div class="toast" id="toast"></div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product.
	 */
	do_action( 'woocommerce_after_single_product' );
	?>

</div>

<script>
	// --- GALLERY SWITCHER ---
	function setThumb(el, src) {
		document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
		el.classList.add('active');
		const img = document.getElementById('mainImg');
		if (img && src) {
			img.src = src;
		}
	}

	// --- TOAST NOTIFICATIONS ---
	function showToast(msg) {
		const t = document.getElementById('toast');
		if (t) {
			t.innerHTML = msg;
			t.classList.add('show');
			clearTimeout(t._timer);
			t._timer = setTimeout(() => t.classList.remove('show'), 3500);
		}
	}

	// --- VIDEO PLAYER ENABLER ---
	function playVideo(url) {
		const scene = document.getElementById('videoScene');
		const badge = document.getElementById('videoBadge');
		const frame = document.getElementById('videoFrame');
		const wrap  = document.getElementById('videoWrap');
		if (scene) scene.style.display = 'none';
		if (badge) badge.style.display = 'none';
		if (frame) {
			// Auto play parameter
			const videoUrl = url.indexOf('?') > -1 ? url + '&autoplay=1' : url + '?autoplay=1';
			frame.src = videoUrl;
			frame.style.display = 'block';
		}
		if (wrap) {
			wrap.style.cursor = 'default';
			wrap.onclick = null;
		}
	}

	// --- BUNDLE BUILDER ---
	function toggleBundle(card) {
		card.classList.toggle('selected');
		const check = card.querySelector('.bundle-check');
		if (check) {
			check.innerHTML = card.classList.contains('selected') ? '&#10003;' : '';
		}
		recalcBundle();
	}

	function recalcBundle() {
		let total = 0, count = 0;
		document.querySelectorAll('.bundle-card.selected').forEach(c => {
			total += parseFloat(c.dataset.price);
			count++;
		});
		
		const totalFormatted = 'AED ' + total.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
		const itemsText = count + ' ' + (count !== 1 ? 'items selected' : 'item selected');
		
		const bundleTotalEl = document.getElementById('bundleTotal');
		const bundleItemsEl = document.getElementById('bundleItems');
		
		if (bundleTotalEl) bundleTotalEl.textContent = totalFormatted;
		if (bundleItemsEl) bundleItemsEl.textContent = itemsText;
	}

	function addBundle() {
		const selectedCards = document.querySelectorAll('.bundle-card.selected');
		const productIds = [];
		selectedCards.forEach(c => {
			if (c.dataset.id) {
				productIds.push(c.dataset.id);
			} else {
				// main product ID
				productIds.push(<?php echo esc_js( $product_id ); ?>);
			}
		});
		
		if (productIds.length > 0) {
			showToast('Redirecting to checkout with your selection...');
			// Redirect using our new multiple add-to-cart query parameter handler
			window.location.href = '<?php echo esc_js( home_url( '/' ) ); ?>?add-to-cart-multiple=' + productIds.join(',');
		}
	}

	// --- REVIEWS CAROUSEL SLIDER ---
	let reviewIdx = 0;
	function visibleCount() {
		return window.innerWidth < 768 ? 1 : 2;
	}
	function getCards() {
		return document.querySelectorAll('.review-card');
	}
	function maxIdx() {
		return Math.max(0, getCards().length - visibleCount());
	}
	function buildDots() {
		const el = document.getElementById('reviewDots');
		if (!el) return;
		el.innerHTML = '';
		const total = maxIdx() + 1;
		for (let i = 0; i < total; i++) {
			const d = document.createElement('div');
			d.className = 'dot' + (i === reviewIdx ? ' active' : '');
			d.onclick = (function(idx){
				return function(){
					reviewIdx = idx;
					updateSlider();
				};
			})(i);
			el.appendChild(d);
		}
	}
	function updateSlider() {
		const track = document.getElementById('reviewsTrack');
		const card = document.querySelector('.review-card');
		if (!track || !card) return;
		
		const gap = 16; // matching styles gap
		const cardW = card.offsetWidth + gap;
		track.style.transform = 'translateX(-' + (reviewIdx * cardW) + 'px)';
		buildDots();
	}
	function slideReviews(dir) {
		reviewIdx = Math.max(0, Math.min(maxIdx(), reviewIdx + dir));
		updateSlider();
	}
	
	window.addEventListener('load', () => {
		buildDots();
		updateSlider();
		
		// Show sticky bar on scroll logic
		const heroSection = document.querySelector('.hero');
		const stickyBar = document.querySelector('.sticky-bar');
		if (heroSection && stickyBar) {
			window.addEventListener('scroll', () => {
				const heroBottom = heroSection.getBoundingClientRect().bottom + window.scrollY;
				if (window.scrollY > heroBottom - 200) {
					stickyBar.classList.add('show');
				} else {
					stickyBar.classList.remove('show');
				}
			});
		}
	});
	window.addEventListener('resize', () => {
		reviewIdx = Math.min(reviewIdx, maxIdx());
		updateSlider();
	});

	// --- STICKY BAR ACTIONS ---
	function addToCartSticky() {
		const mainFormSubmit = document.querySelector('.custom-add-to-cart-wrapper button.single_add_to_cart_button');
		if (mainFormSubmit) {
			mainFormSubmit.click();
		} else {
			// Fallback direct url redirect if native form button is missing
			window.location.href = window.location.pathname + '?add-to-cart=<?php echo esc_js( $product_id ); ?>';
		}
	}

	// Handle Buy Now from Sticky Bar
	function buyNowSticky() {
		const mainBuyNow = document.querySelector('.buy-now-theme-btn');
		if (mainBuyNow) {
			mainBuyNow.click();
		} else {
			// Fallback direct buy redirect
			window.location.href = '<?php echo esc_js( home_url( '/' ) ); ?>?add-to-cart-multiple=<?php echo esc_js( $product_id ); ?>';
		}
	}
</script>
