class wpkitElementorHandler {
	constructor() {
		this.initSettings();
		this.initElements();
		this.boundEvents();

		console.log(this.elements.menuToggle);
	}

	initSettings() {
		this.settings = {
			selectors: {
				menuToggle: '.site-header .site-navigation-toggle',
				menuToggleContainer: '.site-header .site-navigation-toggle-container',
				dropdownMenu: '.site-header .site-navigation-dropdown',
			}
		}
	}

	initElements() {
		this.elements = {
			window,
			menuToggle: document.querySelector(this.settings.selectors.menuToggle),
			menuToggleContainer: document.querySelector(this.settings.selectors.menuToggleContainer),
			dropdownMenu: document.querySelector(this.settings.selectors.dropdownMenu),
		}
	}

	boundEvents() {
		if (!this.elements.menuToggleContainer || this.elements.menuToggleContainer?.classList.contains('hide')) {
			return;
		}

		this.elements.menuToggle.addEventListener('click', () => this.menuToggleHandle());
		this.elements.menuToggle.addEventListener('keyup', (event) => {
			const ENTER_KEY = 13;
			const SPACE_KEY = 32;
			const ESC_KEY = 27;

			if (ENTER_KEY === event.keyCode || SPACE_KEY === event.keyCode || ESC_KEY === event.keyCode) {
				event.currentTarget.click();
			}
		});

		this.elements.dropdownMenu.querySelectorAll('.menu-item-has-children > a').forEach((anchorEl) => anchorEl.addEventListener('click', (event) => this.menuChildrenHandle(event)));

	}

	closeMenuItems() {
		this.elements.menuToggleContainer.classList.remove('is-active');
		this.elements.window.removeEventListener('resize', () => this.closeMenuItems());
	}

	menuToggleHandle() {
		const isDropdownVisible = !this.elements.menuToggleContainer.classList.contains('is-active');

		this.elements.menuToggle.setAttribute('aria-expanded', isDropdownVisible);
		this.elements.dropdownMenu.setAttribute('aria-hidden', !isDropdownVisible);
		this.elements.menuToggleContainer.classList.toggle('is-active', isDropdownVisible);
		this.elements.menuToggle.classList.toggle('is-active', isDropdownVisible);

		// Always close all sub active items.
		this.elements.dropdownMenu.querySelectorAll('.is-active').forEach(item => item.classList.remove('is-active'));

		if (isDropdownVisible) {
			this.elements.window.addEventListener('resize', () => this.closeMenuItems());
		} else {
			this.elements.window.removeEventListener('resize', () => this.closeMenuItems());
		}
	}

	menuChildrenHandle(event) {
		const anchor = event.currentTarget;
		const parentLi = anchor.parentElement;

		if (!parentLi?.classList) {
			return;
		}

		parentLi.classList.toggle('is-active');
	}
}

document.addEventListener('DOMContentLoaded', () => {
	new wpkitElementorHandler();
});
