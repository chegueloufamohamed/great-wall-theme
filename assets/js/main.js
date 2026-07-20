/* ==========================================================================
   GREAT WALL FURNITURE - CORE INTERACTION SCRIPTS
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize all features
  initHeaderScroll();
  initDrawers();
  initHeroSlider();
  initScrollAnimations();
  initMockCart();
  initRecentlyViewed();

  initCurtainSlider();
  initHoverShowcase();
  initWooProductPage();
  initWooShopLoop();
  initShopPriceSlider();
  initViewModeToggle();
  initShopCategoriesSlider();
  initSidebarCategoryAccordion();
  initWooCommerceFeaturedProduct();
  initLoungeScrollDrag();
  initWishlist();
});

/* ==========================================================================
   HEADER SCROLL DYNAMICS
   ========================================================================== */
function initHeaderScroll() {
  const header = document.querySelector('.header');
  const backToTop = document.querySelector('.floating-back-to-top');
  if (!header && !backToTop) return;

  const handleScroll = () => {
    if (header) {
      if (window.scrollY > 50) {
        header.classList.add('sticky');
      } else {
        header.classList.remove('sticky');
      }
    }

    if (backToTop) {
      if (window.scrollY > 300) {
        backToTop.classList.add('visible');
      } else {
        backToTop.classList.remove('visible');
      }
    }
  };

  // Run on load and scroll
  handleScroll();
  window.addEventListener('scroll', handleScroll);
}

/* ==========================================================================
   DRAWERS (Cart & Mobile Menu)
   ========================================================================== */
function initDrawers() {
  const overlay = document.querySelector('.drawer-overlay');
  const cartDrawer = document.getElementById('cart-drawer');
  const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
  const searchDrawer = document.getElementById('search-drawer');
  const wishlistDrawer = document.getElementById('wishlist-drawer');
  
  const cartTriggers = document.querySelectorAll('.cart-trigger');
  const menuTriggers = document.querySelectorAll('.menu-toggle-trigger');
  const searchTriggers = document.querySelectorAll('.search-trigger');
  const wishlistTriggers = document.querySelectorAll('.wishlist-trigger');
  const closeBtns = document.querySelectorAll('.drawer-close');

  if (!overlay) return;

  const openDrawer = (drawer) => {
    overlay.classList.add('active');
    drawer.classList.add('active');
    document.body.style.overflow = 'hidden'; // Lock background scroll
  };

  const closeAllDrawers = () => {
    overlay.classList.remove('active');
    if (cartDrawer) cartDrawer.classList.remove('active');
    if (mobileMenuDrawer) mobileMenuDrawer.classList.remove('active');
    if (searchDrawer) searchDrawer.classList.remove('active');
    if (wishlistDrawer) wishlistDrawer.classList.remove('active');
    document.body.style.overflow = ''; // Unlock background scroll
  };

  // Add click handlers for Cart
  cartTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      if (cartDrawer) openDrawer(cartDrawer);
    });
  });

  // Add click handlers for Mobile Menu
  menuTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      if (mobileMenuDrawer) openDrawer(mobileMenuDrawer);
    });
  });

  // Add click handlers for Wishlist Drawer
  wishlistTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      closeAllDrawers();
      if (wishlistDrawer) {
        openDrawer(wishlistDrawer);
        if (typeof renderWishlistDrawer === 'function') {
          renderWishlistDrawer();
        }
      }
    });
  });

  // Add click handlers for Search
  searchTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      closeAllDrawers();
      if (searchDrawer) {
        openDrawer(searchDrawer);
        setTimeout(() => {
          const input = searchDrawer.querySelector('input[type="search"]');
          if (input) input.focus();
        }, 300);
      }
    });
  });

  // Close triggers
  closeBtns.forEach(btn => {
    btn.addEventListener('click', closeAllDrawers);
  });

  overlay.addEventListener('click', closeAllDrawers);

  // ESC key to close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAllDrawers();
  });

  // Mobile accordion toggle for Shop dropdown
  const mobileDropTrigger = document.querySelector('.mobile-dropdown-trigger');
  if (mobileDropTrigger) {
    mobileDropTrigger.addEventListener('click', (e) => {
      e.preventDefault();
      const parent = mobileDropTrigger.closest('.mobile-nav-item-dropdown');
      parent.classList.toggle('active');
      const icon = mobileDropTrigger.querySelector('.dropdown-icon');
      if (icon) {
        if (parent.classList.contains('active')) {
          icon.className = 'ri-subtract-line dropdown-icon';
        } else {
          icon.className = 'ri-add-line dropdown-icon';
        }
      }
    });
  }
}

/* ==========================================================================
   HERO SLIDER
   ========================================================================== */
function initHeroSlider() {
  const slides = document.querySelectorAll('.hero-slide');
  const prevBtn = document.querySelector('.hero-control-prev');
  const nextBtn = document.querySelector('.hero-control-next');
  const dotsContainer = document.querySelector('.hero-dots');

  if (slides.length === 0) return;

  let currentSlide = 0;
  let slideInterval;
  const intervalTime = 6000;

  // Create dot indicators
  slides.forEach((_, index) => {
    const dot = document.createElement('div');
    dot.classList.add('hero-dot');
    if (index === 0) dot.classList.add('active');
    dot.addEventListener('click', () => {
      goToSlide(index);
      resetAutoplay();
    });
    if (dotsContainer) dotsContainer.appendChild(dot);
  });

  const dots = document.querySelectorAll('.hero-dot');

  const updateDots = () => {
    dots.forEach((dot, index) => {
      if (index === currentSlide) {
        dot.classList.add('active');
      } else {
        dot.classList.remove('active');
      }
    });
  };

  const goToSlide = (n) => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    updateDots();
  };

  const nextSlide = () => {
    goToSlide(currentSlide + 1);
  };

  const prevSlide = () => {
    goToSlide(currentSlide - 1);
  };

  // Nav buttons
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      resetAutoplay();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      resetAutoplay();
    });
  }

  // Autoplay
  const startAutoplay = () => {
    slideInterval = setInterval(nextSlide, intervalTime);
  };

  const resetAutoplay = () => {
    clearInterval(slideInterval);
    startAutoplay();
  };

  startAutoplay();
}

/* ==========================================================================
   SCROLL ANIMATIONS (Intersection Observer)
   ========================================================================== */
function initScrollAnimations() {
  const scrollElements = document.querySelectorAll('[data-scroll]');

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('scroll-active');
          observer.unobserve(entry.target); // Animate once
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -50px 0px'
    });

    scrollElements.forEach(el => observer.observe(el));
  } else {
    // Fallback if IntersectionObserver not supported
    scrollElements.forEach(el => el.classList.add('scroll-active'));
  }
}

/* ==========================================================================
   HIGH-FIDELITY MOCK CART SYSTEM
   ========================================================================== */
function initMockCart() {
  if (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.is_woocommerce) {
    initWooCommerceCartAjaxRemove();
    return;
  }
  let cart = JSON.parse(localStorage.getItem('gwal_cart')) || [];

  const updateCartUI = () => {
    const cartBadge = document.querySelectorAll('.cart-count');
    const cartItemsContainer = document.querySelector('.cart-items');
    const subtotalContainer = document.querySelector('.cart-subtotal-val');
    
    // Save to local storage
    localStorage.setItem('gwal_cart', JSON.stringify(cart));

    // Calculate totals
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // Update badges
    cartBadge.forEach(badge => {
      badge.textContent = totalCount;
      badge.style.display = totalCount > 0 ? 'flex' : 'none';
    });

    // Populate drawer items
    if (cartItemsContainer) {
      if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
          <div class="flex-center" style="height: 100%; flex-direction: column; text-align: center; color: var(--color-muted); gap: 15px;">
            <i class="ri-shopping-bag-line" style="font-size: 3rem; color: var(--color-accent);"></i>
            <p>Your shopping bag is empty.</p>
            <a href="products.html" class="btn btn-secondary drawer-close" style="padding: 10px 24px; font-size: 0.75rem; margin-top: 10px;">Browse Furniture</a>
          </div>
        `;
        
        // Re-bind the dynamically generated drawer close button inside empty state
        const emptyStateClose = cartItemsContainer.querySelector('.drawer-close');
        if (emptyStateClose) {
          emptyStateClose.addEventListener('click', (e) => {
            e.preventDefault();
            const overlay = document.querySelector('.drawer-overlay');
            const cartDrawer = document.getElementById('cart-drawer');
            if (overlay) overlay.classList.remove('active');
            if (cartDrawer) cartDrawer.classList.remove('active');
            document.body.style.overflow = '';
          });
        }
      } else {
        cartItemsContainer.innerHTML = cart.map((item, index) => `
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="${item.image}" alt="${item.title}">
            </div>
            <div class="cart-item-details">
              <div>
                <div class="cart-item-title">${item.title}</div>
                <div class="cart-item-meta">Category: ${item.category}</div>
              </div>
              <div class="cart-item-bottom">
                <div class="cart-item-quantity">
                  <button class="qty-btn dec-btn" data-index="${index}">-</button>
                  <span class="qty-val">${item.quantity}</span>
                  <button class="qty-btn inc-btn" data-index="${index}">+</button>
                </div>
                <div class="cart-item-price">AED ${(item.price * item.quantity).toLocaleString()}</div>
              </div>
              <span class="cart-item-remove" data-index="${index}">Remove</span>
            </div>
          </div>
        `).join('');

        // Bind interactive event listeners for quantity buttons and remove labels
        bindCartItemListeners();
      }
    }

    // Update subtotal
    if (subtotalContainer) {
      subtotalContainer.textContent = `AED ${subtotal.toLocaleString()}`;
    }
  };

  const bindCartItemListeners = () => {
    // Quantity increment
    document.querySelectorAll('.inc-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.getAttribute('data-index'));
        cart[index].quantity += 1;
        updateCartUI();
      });
    });

    // Quantity decrement
    document.querySelectorAll('.dec-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.getAttribute('data-index'));
        if (cart[index].quantity > 1) {
          cart[index].quantity -= 1;
        } else {
          cart.splice(index, 1);
        }
        updateCartUI();
      });
    });

    // Remove item
    document.querySelectorAll('.cart-item-remove').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.getAttribute('data-index'));
        cart.splice(index, 1);
        updateCartUI();
      });
    });
  };

  // Add to cart buttons
  const bindAddToCartButtons = () => {
    document.querySelectorAll('.add-to-cart-trigger').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Grab product data attributes
        const id = btn.getAttribute('data-id') || 'prod-' + Date.now();
        const title = btn.getAttribute('data-title') || 'Luxury Furniture Piece';
        const price = parseFloat(btn.getAttribute('data-price')) || 2499;
        const image = btn.getAttribute('data-image') || 'src/assets/products/placeholder.jpg';
        const category = btn.getAttribute('data-category') || 'Living Room';
        
        // Check if item already in cart
        const existingItemIndex = cart.findIndex(item => item.id === id);
        
        if (existingItemIndex > -1) {
          cart[existingItemIndex].quantity += 1;
        } else {
          cart.push({ id, title, price, image, category, quantity: 1 });
        }
        
        updateCartUI();
        
        // Open the cart drawer to show success
        const cartDrawer = document.getElementById('cart-drawer');
        const overlay = document.querySelector('.drawer-overlay');
        if (cartDrawer && overlay) {
          overlay.classList.add('active');
          cartDrawer.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    });
  };

  // Run updates initially
  updateCartUI();
  bindAddToCartButtons();

  // Custom exposure for product-detail page quantity selector
  const detailAddBtn = document.getElementById('detail-add-to-cart');
  if (detailAddBtn) {
    detailAddBtn.addEventListener('click', (e) => {
      e.preventDefault();
      
      const id = detailAddBtn.getAttribute('data-id');
      const title = detailAddBtn.getAttribute('data-title');
      const price = parseFloat(detailAddBtn.getAttribute('data-price'));
      const image = detailAddBtn.getAttribute('data-image');
      const category = detailAddBtn.getAttribute('data-category');
      
      const qtyInput = document.getElementById('product-qty');
      const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
      
      const existingItemIndex = cart.findIndex(item => item.id === id);
      if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
      } else {
        cart.push({ id, title, price, image, category, quantity });
      }
      
      updateCartUI();
      
      // Open drawer
      const cartDrawer = document.getElementById('cart-drawer');
      const overlay = document.querySelector('.drawer-overlay');
      if (cartDrawer && overlay) {
        overlay.classList.add('active');
        cartDrawer.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  }

  // 1. Featured product (spotlight section) Add to Cart
  const featuredAddBtn = document.getElementById('featured-add-to-cart');
  if (featuredAddBtn) {
    featuredAddBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const id = featuredAddBtn.getAttribute('data-id') || 'prod-velvet-sleek-chair';
      const title = featuredAddBtn.getAttribute('data-title') || 'Velvet Sleek Lounge Chair';
      const price = parseFloat(featuredAddBtn.getAttribute('data-price')) || 2899;
      const image = featuredAddBtn.getAttribute('data-image') || '';
      const category = featuredAddBtn.getAttribute('data-category') || 'Accent Seating';
      
      const qtyInput = document.getElementById('featured-product-qty');
      const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
      
      const existingItemIndex = cart.findIndex(item => item.id === id);
      if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
      } else {
        cart.push({ id, title, price, image, category, quantity });
      }
      
      updateCartUI();
      
      // Open drawer
      const cartDrawer = document.getElementById('cart-drawer');
      const overlay = document.querySelector('.drawer-overlay');
      if (cartDrawer && overlay) {
        overlay.classList.add('active');
        cartDrawer.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  }

  // 2. Featured product (spotlight section) Buy Now
  const featuredBuyBtn = document.getElementById('featured-buy-now');
  if (featuredBuyBtn) {
    featuredBuyBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const id = featuredAddBtn ? featuredAddBtn.getAttribute('data-id') : 'prod-velvet-sleek-chair';
      const title = featuredAddBtn ? featuredAddBtn.getAttribute('data-title') : 'Velvet Sleek Lounge Chair';
      const price = featuredAddBtn ? parseFloat(featuredAddBtn.getAttribute('data-price')) : 2899;
      const image = featuredAddBtn ? featuredAddBtn.getAttribute('data-image') : '';
      const category = featuredAddBtn ? featuredAddBtn.getAttribute('data-category') : 'Accent Seating';
      
      const qtyInput = document.getElementById('featured-product-qty');
      const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
      
      const existingItemIndex = cart.findIndex(item => item.id === id);
      if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
      } else {
        cart.push({ id, title, price, image, category, quantity });
      }
      
      updateCartUI();
      
      // Redirect to checkout
      const fallbackUrl = (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.checkout_url)
        ? greatWallThemeParams.checkout_url
        : 'checkout/';
      const checkoutUrl = featuredBuyBtn.getAttribute('data-checkout-url') || fallbackUrl;
      window.location.href = checkoutUrl;
    });
  }

  // 3. Detail Page Buy Now
  const detailBuyBtn = document.getElementById('detail-buy-now');
  if (detailBuyBtn) {
    detailBuyBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const detailAddBtn = document.getElementById('detail-add-to-cart');
      const id = detailAddBtn ? detailAddBtn.getAttribute('data-id') : 'prod-velvet-sleek-chair';
      const title = detailAddBtn ? detailAddBtn.getAttribute('data-title') : 'Velvet Sleek Lounge Chair';
      const price = detailAddBtn ? parseFloat(detailAddBtn.getAttribute('data-price')) : 2899;
      const image = detailAddBtn ? detailAddBtn.getAttribute('data-image') : '';
      const category = detailAddBtn ? detailAddBtn.getAttribute('data-category') : 'Accent Seating';
      
      const qtyInput = document.getElementById('product-qty');
      const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
      
      const existingItemIndex = cart.findIndex(item => item.id === id);
      if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
      } else {
        cart.push({ id, title, price, image, category, quantity });
      }
      
      updateCartUI();
      
      // Redirect to checkout
      const fallbackUrl = (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.checkout_url)
        ? greatWallThemeParams.checkout_url
        : 'checkout/';
      const checkoutUrl = detailBuyBtn.getAttribute('data-checkout-url') || fallbackUrl;
      window.location.href = checkoutUrl;
    });
  }
}

/* ==========================================================================
   HIGH-FIDELITY RECENTLY VIEWED PRODUCTS DYNAMICS
   ========================================================================== */
function initRecentlyViewed() {
  const detailAddBtn = document.getElementById('detail-add-to-cart');
  const container = document.getElementById('recently-viewed-grid');
  const section = document.getElementById('recently-viewed-section');
  
  // 1. If we are currently on a product detail page, track this product!
  if (detailAddBtn) {
    const id = detailAddBtn.getAttribute('data-id');
    const title = detailAddBtn.getAttribute('data-title');
    const price = parseFloat(detailAddBtn.getAttribute('data-price'));
    const image = detailAddBtn.getAttribute('data-image');
    const category = detailAddBtn.getAttribute('data-category');
    
    let viewed = JSON.parse(localStorage.getItem('gwal_recently_viewed')) || [];
    
    // De-duplicate: remove if exists, then unshift to make it the most recent
    viewed = viewed.filter(item => item.id !== id);
    viewed.unshift({ id, title, price, image, category });
    
    // Cap at 5 items to keep UI clean and proportional
    if (viewed.length > 5) viewed.pop();
    
    localStorage.setItem('gwal_recently_viewed', JSON.stringify(viewed));
  }
  
  // 2. Render recently viewed items in the container, excluding the current product
  if (container) {
    const currentId = detailAddBtn ? detailAddBtn.getAttribute('data-id') : null;
    let viewed = JSON.parse(localStorage.getItem('gwal_recently_viewed')) || [];
    
    // Filter out the product currently being viewed
    const itemsToRender = viewed.filter(item => item.id !== currentId);
    
    if (itemsToRender.length === 0) {
      if (section) section.style.display = 'none';
      return;
    }
    
    if (section) section.style.display = 'block';
    
    container.innerHTML = itemsToRender.map(prod => `
      <div class="product-card">
        <div class="product-img-wrapper" style="height: 280px;">
          <img src="${prod.image}" alt="${prod.title}" class="product-img main-img">
          <div class="product-actions">
            <button class="product-action-btn add-to-cart-trigger" 
                    data-id="${prod.id}" 
                    data-title="${prod.title}" 
                    data-price="${prod.price}" 
                    data-image="${prod.image}"
                    data-category="${prod.category}"
                    title="Add to Shopping Bag">
              <i class="ri-shopping-bag-line"></i>
            </button>
            <a href="product-detail.html?id=${prod.id}" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
          </div>
        </div>
        <div class="product-info">
          <span class="product-category">${prod.category}</span>
          <h3 class="product-title" style="font-size: 0.9rem;"><a href="product-detail.html?id=${prod.id}">${prod.title}</a></h3>
          <div class="product-meta">
            <div class="product-price">AED ${prod.price.toLocaleString()}</div>
          </div>
        </div>
      </div>
    `).join('');
    
    // Bind Add to Cart listeners to recently viewed dynamic items
    const addTriggers = container.querySelectorAll('.add-to-cart-trigger');
    addTriggers.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const price = parseFloat(btn.getAttribute('data-price'));
        const image = btn.getAttribute('data-image');
        const category = btn.getAttribute('data-category');
        
        let cart = JSON.parse(localStorage.getItem('gwal_cart')) || [];
        const existingItemIndex = cart.findIndex(item => item.id === id);
        if (existingItemIndex > -1) {
          cart[existingItemIndex].quantity += 1;
        } else {
          cart.push({ id, title, price, image, category, quantity: 1 });
        }
        localStorage.setItem('gwal_cart', JSON.stringify(cart));
        window.location.reload();
      });
    });
  }
}



/* ==========================================================================
   CURTAIN-SLIDE PARALLAX WATERMARK SHOWCASE (Phase 12)
   ========================================================================== */
function initCurtainSlider() {
  const section = document.querySelector('.curtain-slider-section');
  if (!section) return;

  const slides = section.querySelectorAll('.curtain-slide');
  const wTop = document.getElementById('watermark-top');
  const wBottom = document.getElementById('watermark-bottom');

  if (slides.length < 2) return;

  let current = 0;
  let isAnimating = false;
  let autoplayInterval;

  // Track initial watermark offsets for parallax slide movement
  let topOffset = -20;
  let bottomOffset = -20;

  const moveSlides = (nextIndex) => {
    if (isAnimating) return;
    isAnimating = true;

    const currentSlide = slides[current];
    const nextSlide = slides[nextIndex];

    // Set transition wipe classes
    slides.forEach(s => {
      s.classList.remove('active', 'closing', 'opening');
    });

    currentSlide.classList.add('closing');
    nextSlide.classList.add('opening');

    // Slide/Parallax shift the watermark text as slide transitions
    topOffset += 45;
    bottomOffset -= 45;
    
    // Bounds check to keep watermarks in a readable position
    if (Math.abs(topOffset) > 200) {
      topOffset = topOffset > 0 ? 50 : -50;
      bottomOffset = bottomOffset > 0 ? 50 : -50;
    }

    if (wTop) wTop.style.transform = `translateX(${topOffset}px)`;
    if (wBottom) wBottom.style.transform = `translateX(${bottomOffset}px)`;

    // Wait for clip-path animation to finish (1.2s in CSS)
    setTimeout(() => {
      currentSlide.classList.remove('closing');
      nextSlide.classList.remove('opening');
      nextSlide.classList.add('active');
      
      current = nextIndex;
      isAnimating = false;
    }, 1200);
  };

  const handleNext = () => {
    if (isAnimating) return;
    const nextIndex = (current + 1) % slides.length;
    moveSlides(nextIndex);
  };

  // Autoplay loop
  const startAutoplay = () => {
    autoplayInterval = setInterval(handleNext, 5000);
  };

  startAutoplay();
}

/* ==========================================================================
   INTERACTIVE HOVER CURTAIN SHOWCASE (Phase 13)
   ========================================================================== */
function initHoverShowcase() {
  const section = document.querySelector('.hover-showcase-section');
  if (!section) return;

  const items = section.querySelectorAll('.hover-showcase-item');
  const leftDisplay = section.querySelector('.hover-image-display.side-left');
  const rightDisplay = section.querySelector('.hover-image-display.side-right');

  if (!leftDisplay || !rightDisplay) return;

  const leftImages = leftDisplay.querySelectorAll('.showcase-img');
  const rightImages = rightDisplay.querySelectorAll('.showcase-img');

  items.forEach((item, index) => {
    item.addEventListener('mouseenter', () => {
      // Bypass tracking calculations on mobile touch layout
      if (window.innerWidth <= 768) return;

      const itemRect = item.getBoundingClientRect();
      const sectionRect = section.getBoundingClientRect();

      // Top offset relative to the section container
      const offsetTop = itemRect.top - sectionRect.top;
      const itemHeight = itemRect.height;
      const displayHeight = 240; // match CSS height definition

      // Center visual vertically next to hovered element
      const targetTop = offsetTop + (itemHeight / 2) - (displayHeight / 2);
      const isEven = (index + 1) % 2 === 0;

      if (isEven) {
        // Even indices (2, 4) slide in left side
        leftDisplay.style.top = `${targetTop}px`;
        leftDisplay.classList.add('visible');
        rightDisplay.classList.remove('visible');

        // Index 1 (slide 2) -> left image index 0. Index 3 (slide 4) -> left image index 1.
        const targetImgIndex = Math.floor(index / 2);
        triggerCurtainWipe(leftImages, targetImgIndex);
        closeCurtains(rightImages);
      } else {
        // Odd indices (1, 3) slide in right side
        rightDisplay.style.top = `${targetTop}px`;
        rightDisplay.classList.add('visible');
        leftDisplay.classList.remove('visible');

        // Index 0 (slide 1) -> right image index 0. Index 2 (slide 3) -> right image index 1.
        const targetImgIndex = Math.floor(index / 2);
        triggerCurtainWipe(rightImages, targetImgIndex);
        closeCurtains(leftImages);
      }
    });
  });

  function triggerCurtainWipe(imagesList, targetIndex) {
    if (targetIndex >= imagesList.length) return;

    let activeIndex = -1;
    imagesList.forEach((img, i) => {
      if (img.classList.contains('active')) activeIndex = i;
    });

    if (activeIndex === targetIndex) return; // already active

    // Reset transition anim classes
    imagesList.forEach(img => img.classList.remove('active', 'closing', 'opening'));

    if (activeIndex > -1) {
      imagesList[activeIndex].classList.add('closing');
    }
    imagesList[targetIndex].classList.add('opening');

    setTimeout(() => {
      if (activeIndex > -1) imagesList[activeIndex].classList.remove('closing');
      imagesList[targetIndex].classList.remove('opening');
      imagesList[targetIndex].classList.add('active');
    }, 600); // matches the 0.6s hoverCurtain wipe duration
  }

  function closeCurtains(imagesList) {
    imagesList.forEach(img => {
      if (img.classList.contains('active')) {
        img.classList.remove('active');
        img.classList.add('closing');
        setTimeout(() => {
          img.classList.remove('closing');
        }, 600);
      } else {
        img.classList.remove('active', 'closing', 'opening');
      }
    });
  }

  // Pre-load trigger first element on load to show starting visual
  if (items.length > 0 && window.innerWidth > 768) {
    // Slight delay to ensure DOM styling metrics are failed by browser
    setTimeout(() => {
      items[0].dispatchEvent(new Event('mouseenter'));
    }, 150);
  }
}

/* ==========================================================================
   WOOCOMMERCE SINGLE PRODUCT PAGES DYNAMICS
   ========================================================================== */
function initWooProductPage() {
  const wooAddCartBtn = document.querySelector('.single-product form.cart .single_add_to_cart_button');
  if (wooAddCartBtn) {
    // Check if we already added the Buy Now button
    if (!document.querySelector('.buy-now-theme-btn')) {
      const buyNowBtn = document.createElement('a');
      buyNowBtn.href = '#';
      buyNowBtn.className = 'buy-now-theme-btn';
      buyNowBtn.innerHTML = '<span>Buy Now</span>';
      
      // Let's wrap them in an add-to-cart-row div for proper layout
      const parent = wooAddCartBtn.parentNode;
      const rowDiv = document.createElement('div');
      rowDiv.className = 'add-to-cart-row';
      
      // Move them inside
      parent.insertBefore(rowDiv, wooAddCartBtn);
      rowDiv.appendChild(wooAddCartBtn);
      rowDiv.appendChild(buyNowBtn);
      
      buyNowBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const form = wooAddCartBtn.closest('form.cart');
        if (!form) return;

        const isVariable = form.classList.contains('variations_form') || form.querySelector('.variations');
        const variationIdInput = form.querySelector('input[name="variation_id"]');
        let prodId = '';

        if (isVariable) {
          const variationId = variationIdInput ? variationIdInput.value : '';
          if (!variationId || variationId === '0') {
            // Variation not selected yet, click native add to cart button to trigger WooCommerce validation alerts
            wooAddCartBtn.click();
            return;
          }
          prodId = variationId;
        } else {
          prodId = wooAddCartBtn.value;
          const prodIdInput = form.querySelector('input[name="add-to-cart"]') || form.querySelector('[name="add-to-cart"]');
          if (prodIdInput && prodIdInput.value) {
            prodId = prodIdInput.value;
          }
        }

        const quantityInput = form.querySelector('input.qty') || form.querySelector('[name="quantity"]');
        const qty = quantityInput ? quantityInput.value : 1;
        
        if (prodId) {
          const baseUrl = (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.checkout_url) 
            ? greatWallThemeParams.checkout_url 
            : (window.location.origin + '/checkout/');
          
          const separator = baseUrl.includes('?') ? '&' : '?';
          const checkoutUrl = baseUrl + separator + 'add-to-cart=' + prodId + '&quantity=' + qty;
          window.location.href = checkoutUrl;
        } else {
          form.submit();
        }
      });
    }
  }
}

/**
 * Handle background AJAX removal of WooCommerce products in the sliding drawer cart
 */
function initWooCommerceCartAjaxRemove() {
  document.addEventListener('click', (e) => {
    const removeBtn = e.target.closest('.cart-item-remove-wc');
    if (removeBtn) {
      e.preventDefault();
      const removeUrl = removeBtn.getAttribute('href');
      if (!removeUrl) return;
      
      const cartItem = removeBtn.closest('.cart-item');
      if (cartItem) {
        cartItem.style.opacity = '0.5';
        cartItem.style.pointerEvents = 'none';
      }
      
      fetch(removeUrl)
        .then(response => response.text())
        .then(html => {
          if (window.jQuery) {
            window.jQuery(document.body).trigger('wc_fragment_refresh');
          } else {
            window.location.reload();
          }
        })
        .catch(err => {
          console.error('Error removing item from cart:', err);
          window.location.reload();
        });
    }
  });
}

/**
 * WooCommerce Shop Loop Enhancements (Centering Add to Cart, Injecting Buy Now next to it)
 */
function initWooShopLoop() {
  const loopCartButtons = document.querySelectorAll('.woocommerce ul.products li.product .add_to_cart_button, .woocommerce-page ul.products li.product .add_to_cart_button');
  if (loopCartButtons.length === 0) return;

  loopCartButtons.forEach(btn => {
    // Check if parent is already our custom actions container
    const parent = btn.parentNode;
    if (parent.classList.contains('product-loop-actions')) return;

    const prodId = btn.getAttribute('data-product_id');
    if (!prodId) return;

    // Create a container wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'product-loop-actions';

    // Create Buy Now Button
    const buyNowBtn = document.createElement('a');
    buyNowBtn.className = 'button buy-now-loop-btn';
    
    const baseUrl = (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.checkout_url) 
      ? greatWallThemeParams.checkout_url 
      : (window.location.origin + '/checkout/');

    const separator = baseUrl.includes('?') ? '&' : '?';
    buyNowBtn.href = baseUrl + separator + 'add-to-cart=' + prodId + '&quantity=1';
    buyNowBtn.innerHTML = '<span>Buy Now</span>';

    // Insert wrapper in place of the Add to Cart button
    parent.insertBefore(wrapper, btn);

    // Append both buttons to the wrapper
    wrapper.appendChild(btn);
    wrapper.appendChild(buyNowBtn);
  });
}

/**
 * Shop Price Slider Double Handle Controls & Track Color fill
 */
function initShopPriceSlider() {
  const minInput = document.querySelector('.price-slider-min-input');
  const maxInput = document.querySelector('.price-slider-max-input');
  if (!minInput || !maxInput) return;

  const minValSpan = document.querySelector('.price-val-min');
  const maxValSpan = document.querySelector('.price-val-max');
  const track = document.querySelector('.price-slider-track-bar');

  const updateSlider = () => {
    let minVal = parseInt(minInput.value);
    let maxVal = parseInt(maxInput.value);

    // Enforce min handle doesn't cross max handle
    if (minVal > maxVal - 500) {
      minInput.value = maxVal - 500;
      minVal = maxVal - 500;
    }
    
    if (maxVal < minVal + 500) {
      maxInput.value = minVal + 500;
      maxVal = minVal + 500;
    }

    if (minValSpan) minValSpan.textContent = 'AED ' + minVal.toLocaleString();
    if (maxValSpan) maxValSpan.textContent = 'AED ' + maxVal.toLocaleString();

    // Fill track color dynamically
    if (track) {
      const maxLimit = parseInt(minInput.max) || 15000;
      const percent1 = (minVal / maxLimit) * 100;
      const percent2 = (maxVal / maxLimit) * 100;
      track.style.background = `linear-gradient(to right, var(--border-color) ${percent1}%, var(--color-accent) ${percent1}%, var(--color-accent) ${percent2}%, var(--border-color) ${percent2}%)`;
    }
  };

  minInput.addEventListener('input', updateSlider);
  maxInput.addEventListener('input', updateSlider);
  updateSlider(); // Initial run on mount
}

/**
 * Grid View vs List View Mode Toggles
 */
function initViewModeToggle() {
  const gridBtn = document.querySelector('.view-mode-btn.grid-mode');
  const listBtn = document.querySelector('.view-mode-btn.list-mode');
  const productsList = document.querySelector('.shop-main-content ul.products');
  if (!gridBtn || !listBtn || !productsList) return;

  gridBtn.addEventListener('click', () => {
    gridBtn.classList.add('active');
    listBtn.classList.remove('active');
    productsList.classList.remove('list-view-active');
  });

  listBtn.addEventListener('click', () => {
    listBtn.classList.add('active');
    gridBtn.classList.remove('active');
    productsList.classList.add('list-view-active');
  });
}

/**
 * Shop Subcategories Circular Slider
 */
function initShopCategoriesSlider() {
  const container = document.querySelector('.shop-categories-slider-container');
  if (!container) return;

  const inner = container.querySelector('.shop-categories-slider-inner');
  const slides = container.querySelectorAll('.shop-categories-slide');
  const prevBtn = container.querySelector('.prev-btn');
  const nextBtn = container.querySelector('.next-btn');
  if (!inner || slides.length <= 1) return;

  let currentIndex = 0;
  const slideCount = slides.length;
  let autoplayInterval = null;

  const goToSlide = (index) => {
    if (index < 0) {
      currentIndex = slideCount - 1;
    } else if (index >= slideCount) {
      currentIndex = 0;
    } else {
      currentIndex = index;
    }

    inner.style.transform = `translateX(-${currentIndex * 100}%)`;

    slides.forEach((slide, idx) => {
      if (idx === currentIndex) {
        slide.classList.add('active');
      } else {
        slide.classList.remove('active');
      }
    });
  };

  const startAutoplay = () => {
    autoplayInterval = setInterval(() => {
      goToSlide(currentIndex + 1);
    }, 2000); // Slide every 2s
  };

  const stopAutoplay = () => {
    if (autoplayInterval) {
      clearInterval(autoplayInterval);
    }
  };

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      goToSlide(currentIndex - 1);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      goToSlide(currentIndex + 1);
    });
  }

  // Hover actions to pause/resume autoplay
  container.addEventListener('mouseenter', () => {
    stopAutoplay();
  });

  container.addEventListener('mouseleave', () => {
    startAutoplay();
  });

  startAutoplay();
}

/**
 * Sidebar Categories Accordion Dropdown Toggles
 */
function initSidebarCategoryAccordion() {
  const toggles = document.querySelectorAll('.sub-toggle');
  toggles.forEach(toggle => {
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      const parentLi = this.closest('li.has-children');
      if (!parentLi) return;
      
      const subList = parentLi.querySelector('.sub-list');
      const icon = this.querySelector('i');
      if (!subList || !icon) return;
      
      const isHidden = subList.style.display === 'none' || !subList.style.display;
      if (isHidden) {
        subList.style.display = 'block';
        icon.className = 'ri-arrow-down-s-line';
      } else {
        subList.style.display = 'none';
        icon.className = 'ri-arrow-right-s-line';
      }
    });
  });
}


/**
 * Handle custom quantity increment/decrement buttons click events
 */
document.addEventListener('click', (e) => {
  const button = e.target.closest('.qty-btn');
  if (!button) return;
  
  e.preventDefault();
  const quantityContainer = button.closest('.quantity');
  if (!quantityContainer) return;
  
  const input = quantityContainer.querySelector('input.qty');
  if (!input) return;
  
  const val = parseFloat(input.value) || 1;
  const step = parseFloat(input.getAttribute('step')) || 1;
  const min = parseFloat(input.getAttribute('min')) || 1;
  const max = parseFloat(input.getAttribute('max')) || Infinity;
  
  if (button.classList.contains('plus')) {
    if (val + step <= max) {
      input.value = val + step;
    }
  } else if (button.classList.contains('minus')) {
    if (val - step >= min) {
      input.value = val - step;
    }
  }
  
  // Trigger change event so WooCommerce detects the update
  const event = new Event('change', { bubbles: true });
  input.dispatchEvent(event);
});

/**
 * Inject and initialize navigation arrow controls in single product gallery
 */
window.addEventListener('load', () => {
  const gallery = document.querySelector('.woocommerce-product-gallery');
  if (gallery && typeof jQuery !== 'undefined') {
    // Check if there are multiple images before adding arrows
    const images = gallery.querySelectorAll('.woocommerce-product-gallery__image');
    if (images.length <= 1) return;

    // Create prev button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'gallery-nav-btn prev';
    prevBtn.setAttribute('type', 'button');
    prevBtn.setAttribute('aria-label', 'Previous Image');
    prevBtn.innerHTML = '<i class="ri-arrow-left-s-line"></i>';
    
    // Create next button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'gallery-nav-btn next';
    nextBtn.setAttribute('type', 'button');
    nextBtn.setAttribute('aria-label', 'Next Image');
    nextBtn.innerHTML = '<i class="ri-arrow-right-s-line"></i>';
    
    gallery.appendChild(prevBtn);
    gallery.appendChild(nextBtn);
    
    // Handle navigation click triggers
    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      jQuery('.woocommerce-product-gallery').flexslider('prev');
    });
    
    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      jQuery('.woocommerce-product-gallery').flexslider('next');
    });

    // Pause gallery slideshow when clicked/tapped (on mobile/desktop)
    const pauseGallery = () => {
      const $gallery = jQuery('.woocommerce-product-gallery');
      if ($gallery.length && $gallery.data('flexslider')) {
        $gallery.flexslider('pause');
      }
    };
    gallery.addEventListener('click', pauseGallery);
    gallery.addEventListener('touchstart', pauseGallery, { passive: true });
    
    // Also pause if the navigation buttons are clicked
    prevBtn.addEventListener('click', pauseGallery);
    nextBtn.addEventListener('click', pauseGallery);
  }
});

/**
 * Initialize product thumbnail carousel with continuous slow "train-like" scroll
 * Animates slowly and smoothly using requestAnimationFrame. Pauses on hover, touch, or click.
 */
window.addEventListener('load', () => {
  const thumbsList = document.querySelector('.woocommerce-product-gallery ol.flex-control-thumbs');
  if (thumbsList) {
    const items = thumbsList.querySelectorAll('li');
    if (items.length <= 1) return;

    const parent = thumbsList.parentNode;
    
    // Wrap ol.flex-control-thumbs in a helper slider container if not already wrapped
    let wrapper = parent.querySelector('.thumbs-slider-wrapper');
    if (!wrapper) {
      wrapper = document.createElement('div');
      wrapper.className = 'thumbs-slider-wrapper';
      parent.insertBefore(wrapper, thumbsList);
      wrapper.appendChild(thumbsList);
      
      // Create arrow buttons
      const prevBtn = document.createElement('button');
      prevBtn.className = 'thumb-nav-btn prev';
      prevBtn.setAttribute('type', 'button');
      prevBtn.setAttribute('aria-label', 'Previous Thumbnails');
      prevBtn.innerHTML = '<i class="ri-arrow-left-s-line"></i>';
      
      const nextBtn = document.createElement('button');
      nextBtn.className = 'thumb-nav-btn next';
      nextBtn.setAttribute('type', 'button');
      nextBtn.setAttribute('aria-label', 'Next Thumbnails');
      nextBtn.innerHTML = '<i class="ri-arrow-right-s-line"></i>';
      
      wrapper.appendChild(prevBtn);
      wrapper.appendChild(nextBtn);
    }

    // Continuous scroll animation logic
    let animationId = null;
    let isPaused = false;
    let scrollSpeed = 0.5; // Pixels per frame (very slow, smooth continuous animation)
    let currentScroll = thumbsList.scrollLeft;
    let resumeTimeout = null;

    const animateScroll = () => {
      if (!isPaused) {
        currentScroll += scrollSpeed;
        const maxScroll = thumbsList.scrollWidth - thumbsList.clientWidth;
        
        if (currentScroll >= maxScroll) {
          currentScroll = 0;
        }
        thumbsList.scrollLeft = currentScroll;
      }
      animationId = requestAnimationFrame(animateScroll);
    };

    const startAnimation = () => {
      if (!animationId) {
        animateScroll();
      }
    };

    const stopAnimation = () => {
      isPaused = true;
      if (resumeTimeout) {
        clearTimeout(resumeTimeout);
        resumeTimeout = null;
      }
    };

    const resumeAnimation = () => {
      // Sync currentScroll with actual scroll position
      currentScroll = thumbsList.scrollLeft;
      isPaused = false;
    };

    const triggerTemporaryPause = (ms) => {
      stopAnimation();
      resumeTimeout = setTimeout(resumeAnimation, ms);
    };

    // Pause on hover (desktop)
    wrapper.addEventListener('mouseenter', stopAnimation);
    wrapper.addEventListener('mouseleave', resumeAnimation);

    // Pause on touch (mobile)
    wrapper.addEventListener('touchstart', stopAnimation, { passive: true });
    wrapper.addEventListener('touchend', () => {
      triggerTemporaryPause(1500); // Resume after 1.5 seconds once touch scroll settles
    });

    // Navigation buttons scroll increments
    const navScrollAmount = 102; // Item width + gap
    wrapper.querySelector('.thumb-nav-btn.prev').addEventListener('click', (e) => {
      e.preventDefault();
      thumbsList.scrollBy({ left: -navScrollAmount, behavior: 'smooth' });
      triggerTemporaryPause(3000); // Pause for 3s after button navigation click
    });

    wrapper.querySelector('.thumb-nav-btn.next').addEventListener('click', (e) => {
      e.preventDefault();
      thumbsList.scrollBy({ left: navScrollAmount, behavior: 'smooth' });
      triggerTemporaryPause(3000); // Pause for 3s after button navigation click
    });

    // Pause on manual thumbnail click to let the user choose & view the featured photo
    thumbsList.addEventListener('click', () => {
      triggerTemporaryPause(6000); // Pause for 6 seconds when choosing featured image
    });

    // Start the marquee scroll
    startAnimation();
  }
});

/**
 * Initialize WooCommerce integrations for the Homepage Featured Spotlight Section
 */
function initWooCommerceFeaturedProduct() {
  if (typeof greatWallThemeParams === 'undefined' || !greatWallThemeParams.is_woocommerce) {
    return;
  }
  
  const featuredAddBtn = document.getElementById('featured-add-to-cart');
  const featuredBuyBtn = document.getElementById('featured-buy-now');
  
  if (featuredAddBtn) {
    featuredAddBtn.addEventListener('click', (e) => {
      e.preventDefault();
      
      const prodId = featuredAddBtn.getAttribute('data-id') || '1019';
      const qtyInput = document.getElementById('featured-product-qty');
      const qty = qtyInput ? parseInt(qtyInput.value) : 1;
      
      featuredAddBtn.disabled = true;
      featuredAddBtn.style.opacity = '0.5';
      
      const formData = new FormData();
      formData.append('add-to-cart', prodId);
      formData.append('quantity', qty);
      
      fetch(window.location.origin + '/', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        featuredAddBtn.disabled = false;
        featuredAddBtn.style.opacity = '1';
        
        if (window.jQuery) {
          window.jQuery(document.body).trigger('wc_fragment_refresh');
        }
        
        const cartDrawer = document.getElementById('cart-drawer');
        const overlay = document.querySelector('.drawer-overlay');
        if (cartDrawer && overlay) {
          overlay.classList.add('active');
          cartDrawer.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      })
      .catch(err => {
        featuredAddBtn.disabled = false;
        featuredAddBtn.style.opacity = '1';
        console.error('Error adding to WooCommerce cart:', err);
      });
    });
  }
  
  if (featuredBuyBtn) {
    featuredBuyBtn.addEventListener('click', (e) => {
      e.preventDefault();
      
      const prodId = featuredAddBtn ? (featuredAddBtn.getAttribute('data-id') || '1019') : '1019';
      const qtyInput = document.getElementById('featured-product-qty');
      const qty = qtyInput ? parseInt(qtyInput.value) : 1;
      
      const baseUrl = greatWallThemeParams.checkout_url || (window.location.origin + '/checkout/');
      const separator = baseUrl.includes('?') ? '&' : '?';
      window.location.href = baseUrl + separator + 'add-to-cart=' + prodId + '&quantity=' + qty;
    });
  }
}

/**
 * Enable smooth drag-to-scroll behavior for the RLS-3 horizontal showroom strip
 */
function initLoungeScrollDrag() {
  const slider = document.querySelector('.rls-horizontal-scroll');
  if (!slider) return;

  let isDown = false;
  let startX;
  let scrollLeft;

  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.style.cursor = 'grabbing';
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.style.cursor = 'grab';
  });

  slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.style.cursor = 'grab';
  });

  slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 1.5; // Scroll speed multiplier
    slider.scrollLeft = scrollLeft - walk;
  });
}

/* ==========================================================================
   WISHLIST CORE FUNCTIONALITY (Local Storage Based)
   ========================================================================== */

function initWishlist() {
  updateWishlistBadge();
  updateWishlistButtonsUI();

  // Delegation on click of wishlist toggle buttons anywhere in page
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-wishlist-toggle');
    if (btn) {
      e.preventDefault();
      e.stopPropagation();

      const id = btn.getAttribute('data-product-id');
      const name = btn.getAttribute('data-product-name');
      const price = btn.getAttribute('data-product-price');
      const img = btn.getAttribute('data-product-img');
      const link = btn.getAttribute('data-product-link');

      if (id) {
        toggleWishlistItem(id, name, price, img, link, btn);
      }
    }
  });
}

function getWishlist() {
  try {
    const items = localStorage.getItem('great_wall_wishlist');
    return items ? JSON.parse(items) : [];
  } catch (e) {
    console.error('Error reading wishlist from localStorage:', e);
    return [];
  }
}

function saveWishlist(wishlist) {
  try {
    localStorage.setItem('great_wall_wishlist', JSON.stringify(wishlist));
  } catch (e) {
    console.error('Error writing wishlist to localStorage:', e);
  }
}

function toggleWishlistItem(id, name, price, img, link, clickedBtn = null) {
  let wishlist = getWishlist();
  const existingIndex = wishlist.findIndex(item => item.id === id);

  if (existingIndex > -1) {
    // Remove from wishlist
    wishlist.splice(existingIndex, 1);
    showWishlistToast(name + ' removed from wishlist.');
  } else {
    // Add to wishlist
    wishlist.push({ id, name, price, img, link });
    showWishlistToast(name + ' added to wishlist.', true);
  }

  saveWishlist(wishlist);
  updateWishlistBadge();
  updateWishlistButtonsUI();

  // If we are currently in the wishlist drawer, re-render it
  const wishlistDrawer = document.getElementById('wishlist-drawer');
  if (wishlistDrawer && wishlistDrawer.classList.contains('active')) {
    renderWishlistDrawer();
  }
}

function updateWishlistBadge() {
  const wishlist = getWishlist();
  const badges = document.querySelectorAll('.wishlist-count');
  badges.forEach(badge => {
    if (wishlist.length === 0) {
      badge.style.display = 'none';
      badge.textContent = '0';
    } else {
      badge.style.display = 'flex';
      badge.textContent = wishlist.length;
    }
  });
}

function updateWishlistButtonsUI() {
  const wishlist = getWishlist();
  const wishlistIds = wishlist.map(item => item.id);

  const buttons = document.querySelectorAll('.btn-wishlist-toggle');
  buttons.forEach(btn => {
    const id = btn.getAttribute('data-product-id');
    const icon = btn.querySelector('.wishlist-icon');
    
    if (wishlistIds.includes(id)) {
      btn.classList.add('active');
      if (icon) {
        icon.className = 'ri-heart-fill wishlist-icon';
      }
    } else {
      btn.classList.remove('active');
      if (icon) {
        icon.className = 'ri-heart-line wishlist-icon';
      }
    }
  });
}

function renderWishlistDrawer() {
  const container = document.getElementById('wishlist-items-container');
  const emptyMsg = document.getElementById('wishlist-empty-msg');
  if (!container || !emptyMsg) return;

  const wishlist = getWishlist();
  container.innerHTML = '';

  if (wishlist.length === 0) {
    container.style.display = 'none';
    emptyMsg.style.display = 'block';
  } else {
    container.style.display = 'flex';
    emptyMsg.style.display = 'none';

    const origin = window.location.origin;

    wishlist.forEach(item => {
      // Add-to-cart link via query args (natively supported by WooCommerce)
      const addToCartUrl = `${origin}/?add-to-cart=${item.id}`;
      
      const itemHtml = `
        <div class="wishlist-item" data-product-id="${item.id}">
          <div class="wishlist-item-img">
            <a href="${item.link}"><img src="${item.img}" alt="${item.name}"></a>
          </div>
          <div class="wishlist-item-details">
            <div class="wishlist-item-title"><a href="${item.link}">${item.name}</a></div>
            <div class="wishlist-item-price">${item.price}</div>
            <div class="wishlist-item-actions">
              <a href="${addToCartUrl}" class="btn btn-primary wishlist-add-to-cart"><span>Add to Bag</span></a>
              <button type="button" class="wishlist-item-remove" data-id="${item.id}" title="Remove"><i class="ri-delete-bin-line"></i></button>
            </div>
          </div>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', itemHtml);
    });

    // Add click listeners to remove buttons inside drawer
    container.querySelectorAll('.wishlist-item-remove').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const id = btn.getAttribute('data-id');
        const item = wishlist.find(item => item.id === id);
        if (id) {
          toggleWishlistItem(id, item ? item.name : 'Product', '', '', '');
        }
      });
    });
  }
}

// Simple Toast Notification for Wishlist events
function showWishlistToast(message, isHeart = false) {
  // Check if active toast exists
  let toast = document.querySelector('.wishlist-toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'wishlist-toast';
    document.body.appendChild(toast);
  }
  
  const icon = isHeart ? '<i class="ri-heart-fill" style="color: #ff3366; margin-right: 8px;"></i>' : '<i class="ri-delete-bin-line" style="color: #c5a880; margin-right: 8px;"></i>';
  toast.innerHTML = icon + `<span>${message}</span>`;
  toast.classList.add('show');

  // Slide up/fade out
  setTimeout(() => {
    toast.classList.remove('show');
  }, 2500);
}


