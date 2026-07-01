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
  
  const cartTriggers = document.querySelectorAll('.cart-trigger');
  const menuTriggers = document.querySelectorAll('.menu-toggle-trigger');
  const searchTriggers = document.querySelectorAll('.search-trigger');
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
      
      const applePayBtn = document.createElement('a');
      applePayBtn.href = '#';
      applePayBtn.className = 'apple-pay-theme-btn';
      applePayBtn.innerHTML = '<span> Pay</span>';
      
      const googlePayBtn = document.createElement('a');
      googlePayBtn.href = '#';
      googlePayBtn.className = 'google-pay-theme-btn';
      googlePayBtn.innerHTML = '<span><svg width="45" height="18" viewBox="0 0 54 22" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; display: inline-block; margin-top: -3px;"><path d="M19.3 6.12h-2.53v6.62h-1.27V6.12H13v-1.06h6.3v1.06zm2.5 2.35c.48 0 .85.13 1.12.4.27.27.4.64.4 1.1v2.77h-1.23v-.64c-.2.24-.45.43-.72.56s-.57.2-0.92.2c-.45 0-.83-.13-1.12-.4-.29-.27-.44-.63-.44-1.08 0-.49.16-.87.48-1.12.32-.25.79-.38 1.4-.38h1.2v-.27c0-.29-.08-.52-.24-.68-.16-.16-.4-.24-.76-.24-.27 0-.5.05-.72.16-.22.1-.4.27-.6.48l-.75-.58c.28-.32.6-.56.96-.72.36-.16.75-.24 1.16-.24zm.3 2.64v-.61h-1.05c-.3 0-.55.07-.72.2-.17.13-.25.32-.25.56 0 .21.07.38.2.52.13.13.33.2.6.2.28 0 .53-.07.76-.2.23-.13.39-.33.46-.67zm5.7-2.53l-2.6 5.96h-1.28l.97-2.16-1.72-3.8h1.35l.97 2.37.95-2.37h1.36z" fill="currentColor"/><path d="M2.93 12.3c-1.37 0-2.48-1.11-2.48-2.48s1.11-2.48 2.48-2.48c.67 0 1.25.26 1.7.7l-1.2 1.2c-.13-.13-.3-.22-.5-.22-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25c.69 0 1.25-.56 1.25-1.25h-1.25V9.16h2.5c.03.14.05.29.05.45 0 1.48-1.2 2.69-2.69 2.69zm5.3-2.48c0 1.37-1.11 2.48-2.48 2.48S3.27 11.19 3.27 9.82 4.38 7.34 5.75 7.34 8.23 8.45 8.23 9.82zm-1.23 0c0-.69-.56-1.25-1.25-1.25s-1.25.56-1.25 1.25.56 1.25 1.25 1.25 1.25-.56 1.25-1.25zm5.3 0c0 1.37-1.11 2.48-2.48 2.48s-2.48-1.11-2.48-2.48 1.11-2.48 2.48-2.48 2.48 1.11 2.48 2.48zm-1.23 0c0-.69-.56-1.25-1.25-1.25s-1.25.56-1.25 1.25.56 1.25 1.25 1.25 1.25-.56 1.25-1.25zm5.3 0c0 1.37-1.11 2.48-2.48 2.48s-2.48-1.11-2.48-2.48 1.11-2.48 2.48-2.48 2.48 1.11 2.48 2.48zm-1.23 0c0-.69-.56-1.25-1.25-1.25s-1.25.56-1.25 1.25.56 1.25 1.25 1.25 1.25-.56 1.25-1.25zm3.84 2.33v-4.5h1.23v4.5h-1.23zm.62-5.18c-.41 0-.75-.34-.75-.75s.34-.75.75-.75.75.34.75.75-.34.75-.75.75z" fill="currentColor"/></svg></span>';
      
      // Let's wrap them in an add-to-cart-row div for proper layout
      const parent = wooAddCartBtn.parentNode;
      const rowDiv = document.createElement('div');
      rowDiv.className = 'add-to-cart-row';
      
      // Move them inside
      parent.insertBefore(rowDiv, wooAddCartBtn);
      rowDiv.appendChild(wooAddCartBtn);
      rowDiv.appendChild(buyNowBtn);
      rowDiv.appendChild(applePayBtn);
      rowDiv.appendChild(googlePayBtn);
      
      const triggerBuyRedirect = () => {
        const form = wooAddCartBtn.closest('form.cart');
        const quantityInput = form.querySelector('input.qty') || form.querySelector('[name="quantity"]');
        const qty = quantityInput ? quantityInput.value : 1;
        
        // Find product ID
        let prodId = wooAddCartBtn.value;
        const prodIdInput = form.querySelector('input[name="add-to-cart"]') || form.querySelector('[name="add-to-cart"]');
        if (prodIdInput) {
          prodId = prodIdInput.value;
        }
        
        if (prodId) {
          // Redirect to checkout with add to cart query parameters
          const baseUrl = (typeof greatWallThemeParams !== 'undefined' && greatWallThemeParams.checkout_url) 
            ? greatWallThemeParams.checkout_url 
            : (window.location.origin + '/checkout/');
          
          const separator = baseUrl.includes('?') ? '&' : '?';
          const checkoutUrl = baseUrl + separator + 'add-to-cart=' + prodId + '&quantity=' + qty;
          window.location.href = checkoutUrl;
        } else {
          form.submit();
        }
      };

      buyNowBtn.addEventListener('click', (e) => {
        e.preventDefault();
        triggerBuyRedirect();
      });

      applePayBtn.addEventListener('click', (e) => {
        e.preventDefault();
        triggerBuyRedirect();
      });

      googlePayBtn.addEventListener('click', (e) => {
        e.preventDefault();
        triggerBuyRedirect();
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
