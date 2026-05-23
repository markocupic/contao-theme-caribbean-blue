class StickyHeader {
  constructor(id, options = {}) {
    if (!id) {
      throw new Error("StickyHeader: 'id' is required.");
    }

    this.header = document.getElementById(id);
    if (!this.header) {
      throw new Error(`StickyHeader: Element with id '${id}' not found.`);
    }

    // Default options
    this.options = {
      offset: options.offset ?? 150,      // Header behavior activates only after this scroll depth
      threshold: options.threshold ?? 4   // Prevents jitter when detecting scroll direction
    };

    this.lastY = window.scrollY;
    this.ticking = false;

    this.bindEvents();
  }

  bindEvents() {
    // Use requestAnimationFrame for smooth, performant updates
    window.addEventListener('scroll', () => {
      if (!this.ticking) {
        window.requestAnimationFrame(() => this.update());
        this.ticking = true;
      }
    });
  }

  update() {
    const currentY = window.scrollY;

    // Keep header visible until the scroll offset is reached
    if (currentY < this.options.offset) {
      this.pin();
      this.lastY = currentY;
      this.ticking = false;
      return;
    }

    // Scrolling up → show header
    if (currentY < this.lastY - this.options.threshold) {
      this.pin();
    }

    // Scrolling down → hide header
    else if (currentY > this.lastY + this.options.threshold) {
      this.unpin();
    }

    this.lastY = currentY;
    this.ticking = false;
  }

  pin() {
    // Add class to show header
    this.header.classList.add('header--pinned');
    this.header.classList.remove('header--unpinned');
  }

  unpin() {
    // Add class to hide header
    this.header.classList.add('header--unpinned');
    this.header.classList.remove('header--pinned');
  }
}

