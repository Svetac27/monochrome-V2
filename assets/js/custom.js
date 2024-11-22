	// Function to preload images
	function preloadImages(url) {
		const img = new Image();
		img.src = url;
	}

	function loadHiddenImages() {
		document.querySelectorAll('[data-slides]').forEach(item => {
			const slideJson = JSON.parse(item.getAttribute('data-slide') || '[]')
			slideJson.forEach(slide => {
				if (slide.background) {
					loadImage(slide.background)
				}
				if (slide.image) {
					loadImage(slide.image)
				}
			})
		})
	}

	function handleModalToggle () {
		document.querySelectorAll('.--js-close-contact-modal').forEach(item => {
			item.addEventListener('click', function (e) {
				e.target.closest('.contact-modal').style.opacity = 0
			
				setTimeout(function () {
					document.querySelector('.open-contact-modal').classList.remove('open-contact-modal')
					e.target.closest('.contact-modal').removeAttribute('style')

					const successElm = e.target.closest('.show-success')
					if (successElm) {
						successElm.classList.remove('show-success')
					}
					handleModalIndex(false)

				}, 300)
			})
		})
	}
	const handleContactTabs = () => {
		document.querySelectorAll('.contact-modal').forEach(item => {
			item.querySelectorAll('.form-dropdown select').forEach(selectElm => {
				selectElm.addEventListener('change', function (e) {
					e.preventDefault()

					item.querySelectorAll('.forms > div').forEach(formItem => formItem.classList.add('hidden'))
					item.querySelector(`.forms [data-index="${selectElm.value}"`).classList.remove('hidden')

					
					return false
				})
			})
		})
	}
	window.addEventListener( 'DOMContentLoaded', function() {
		// load all slide images
		loadHiddenImages()

		const allSliders = document.querySelectorAll( '.carousel-slider' );

		allSliders.forEach( ( wrapper ) => {
			const slide = wrapper.querySelector( '.slideshow-container' );

			let timeoutHandler;
			const updateDisplayedSlide = ( n ) => {
				if ( timeoutHandler ) {
					clearTimeout( timeoutHandler );
				}

				slide.setAttribute( 'data-current-slide', n );

				const timer = wrapper.querySelectorAll( '.slide-timer .timer' );

				if ( timer[ n - 1 ] ) {
					timer[ n - 1 ].classList.add( 'active' );
					setTimeout(() => {
						timer[ n - 1 ].classList.add( 'slide-right' );
					}, 2000);
				}

				timer.forEach( ( item, index ) => {
					if ( index >= n ) {
						item.classList.remove( 'active' );
					}
				} );

				slide.querySelectorAll( '.mySlides' ).forEach( ( item ) => {
					if ( +item.getAttribute( 'data-slide' ) === +n ) {
						item.style.display = 'block';
					} else {
						item.style.display = 'none';
					}
				} );

				timeoutHandler = setTimeout( function() {
					const currentSlide = +slide.getAttribute( 'data-current-slide' );
					let nextSlide = currentSlide + 1;

					if ( nextSlide > +slide.getAttribute( 'data-items-count' ) ) {
						nextSlide = 1;
					}
					updateDisplayedSlide( nextSlide );
				}, 3000 );
			};

			// default
			updateDisplayedSlide( 1 );

			// setInterval( function() {
			// 	const currentSlide = +slide.getAttribute( 'data-current-slide' );
			// 	let nextSlide = currentSlide + 1;

			// 	if ( nextSlide > +slide.getAttribute( 'data-items-count' ) ) {
			//         updateDisplayedSlide(0);
			// 		nextSlide = 1;
			// 	}
			// 	updateDisplayedSlide( nextSlide );
			// }, 3000 );

			wrapper.querySelector( '.prev' ).addEventListener( 'click', function() {
				let currentSlide = +slide.getAttribute( 'data-current-slide' );
				const totalItem = +slide.getAttribute( 'data-items-count' );

				if ( currentSlide === 1 ) {
					currentSlide = totalItem;
				} else {
					currentSlide = currentSlide - 1;
				}
				updateDisplayedSlide( currentSlide );
			} );

			wrapper.querySelector( '.next' ).addEventListener( 'click', function() {
				let currentSlide = +slide.getAttribute( 'data-current-slide' );
				const totalItem = +slide.getAttribute( 'data-items-count' );

				if ( currentSlide === totalItem ) {
					currentSlide = 1;
				} else {
					currentSlide = currentSlide + 1;
				}
				updateDisplayedSlide( currentSlide );
			} );
		} );


		handleModalToggle()

		handleContactTabs()
	} );


	function adjustActiveIndicator (wrapper) {
		const indicator = wrapper.querySelector('.active-indicator')
		const activeTab = wrapper.querySelector('.product-item.current')
		const height = activeTab.offsetHeight
		const top = activeTab.offsetTop

		indicator.style.height = `${height}px`
		indicator.style.top = `${top}px`
	}


	document.querySelectorAll('.--js-product-item').forEach(item => {
		adjustActiveIndicator(item.parentNode)

		const displayIndex = item.getAttribute('data-index');

		item.addEventListener('click', function() {
			const parent = this.closest('.product-wrapper')

			parent.querySelectorAll('.product-content').forEach(content => {
				content.style.display = 'none';
			})

			parent.querySelectorAll(`.product-content-${displayIndex}`).forEach(content => {
				content.style.display = 'block';
			})

			parent.querySelectorAll('.product-item').forEach(elm => {
				elm.classList.remove('current');
			})

			this.classList.add('current');

			adjustActiveIndicator(item.parentNode)
		})
	});


	document.querySelectorAll('.--js-package-includes').forEach(item => {

		item.addEventListener('click', function(e) {
			e.preventDefault()

			const packageId = this.getAttribute('data-package')
			const wrapper = this.closest('.pricing-packages')

			wrapper.querySelectorAll('li').forEach(li => {
				li.querySelector('a').classList.remove('border-b-2px','border-blue')
				li.querySelector('a').classList.add('opacity-70')
			})

			this.classList.add('border-b-2px','border-blue')
			this.classList.remove('opacity-70')

			wrapper.querySelectorAll('.package-item').forEach(package => {
				package.classList.add('hidden')
			})
			wrapper.querySelectorAll(`.package-${packageId}`).forEach(package => {
				package.classList.remove('hidden')
			})

			return false;
		})

	})

	document.querySelectorAll('.faq-answer').forEach(answer => {
		answer.classList.remove('h-auto')
		answer.classList.add('h-0')
	})

	document.querySelectorAll('.accordion-title').forEach(item => {
		
		item.addEventListener('click', function () {
			const faqAns = this.closest('li').querySelector('.faq-answer')
			const wrapper = item.closest('.faqs')
			const isExpanded = !!faqAns.closest('li').classList.contains('open')

			wrapper.querySelectorAll('.faq-answer').forEach(answer => {
				answer.style.height = '0'

				answer.closest('li').classList.remove('open')
			})

			if (!isExpanded) {
				const screenWidth = window.innerWidth;
				let bottomPadding = 25
				switch (true) {
					case screenWidth <= 768:
						bottomPadding = 15
						break;
					case screenWidth > 768 && screenWidth <= 1023:
						bottomPadding = 15
						break;
				}

				faqAns.style.height = `${faqAns.scrollHeight + bottomPadding}px`
				faqAns.closest('li').classList.add('open')
			}
		})
	})

	function showHideNoItemsFound () {
		const ecLen = document.querySelectorAll('.ec-elm .showcase-item:not(.hidden)').length
		const pubLen = document.querySelectorAll(`.pc-contents .showcase-item:not(.hidden)`).length 

		
		document.querySelectorAll('.no-public-designs-found').forEach(elm => elm.style.display = 'none')
		document.querySelectorAll('.no-designs-found').forEach(elm => elm.style.display = 'none')

		if (pubLen === 0) {
			if (ecLen === 0) {
				document.querySelectorAll('.no-designs-found').forEach(elm => elm.style.display = 'block')
			} else {
				document.querySelectorAll('.no-public-designs-found').forEach(elm => elm.style.display = 'block')
			}
		}
	}
	showHideNoItemsFound()

	let selectedShowcasePlatform = '';
	let selectedShowcaseTypes = '';
	function setSelectedPlatform (value) {
		selectedShowcasePlatform = value
		filterShowcaseProjects()
	}
	function setSelectedTypes (value) {
		selectedShowcaseTypes = value
		filterShowcaseProjects()
	}

	
	document.querySelectorAll('.clear-filters').forEach(item => {
		item.addEventListener('click', function () {
			
			//  not working
			// setSelectedPlatform('')

			// alternative
			document.querySelector('.--js-showcase-platform[data-value="all"]').click()


			setSelectedTypes('')

			
			document.querySelectorAll('.filter-options .--js-showcase-types').forEach(type => {
				type.classList.remove('active')
			})
		})
	})

	function filterShowcaseProjects () {
		selectedShowcasePlatform = document.querySelector('.--js-showcase-platform.font-bold').getAttribute('data-value').trim().toLocaleLowerCase().replace(/ /g,'-')
		const validPlatformClass = selectedShowcasePlatform && selectedShowcasePlatform !== 'all' && selectedShowcasePlatform !== '' ? `showcase-platform-${selectedShowcasePlatform}` : false
		const validTypeClasses = selectedShowcaseTypes.split(',').filter(item => item).map(item => `showcase-type-${item}`)

		if (selectedShowcaseTypes === '' && ['','all'].includes(selectedShowcasePlatform) !== false) {
			document.querySelectorAll('button.clear-filters').forEach(cls => cls.style.display = 'none')
		} else {
			document.querySelectorAll('button.clear-filters').forEach(cls => cls.style.display = 'inline-block')
		}


		const checkTypeClasses = (elm) => {

			if (!validTypeClasses || !validTypeClasses.length) {
				return true
			}

			const matchingClasses = []
			elm.classList.forEach(className => {
				if (className.startsWith('showcase-type-')) {
					matchingClasses.push(className);
				}
			});

			return validTypeClasses.every(value => matchingClasses.includes(value));
		}

		const checkPlatform = (elm) => {
			if (!validPlatformClass || !validPlatformClass.length) {
				return true
			}
			return elm.classList.contains(validPlatformClass)
		}

		let itemSelector = '.showcase-item';
		// if (!document.querySelector('body').classList.contains('ec-allowed')) {
		// 	itemSelector = '.pc-contents .showcase-item';
		// }

		let index = 1;
		document.querySelectorAll(itemSelector).forEach(item => {
			if (checkTypeClasses(item) && checkPlatform(item)) {
				item.classList.remove('hidden')

				if (item.closest('.locked-items-wrapper')) {
					if (index < 4) {
						item.classList.add('first-row')
					}
					index++
				}
			} else {
				item.classList.add('hidden')
			}
		})
		showHideExclusiveSection()

		showHideNoItemsFound()
	}

	const showHideExclusiveSection = function () {
		if (document.querySelectorAll('.ec-elm .showcase-item:not(.hidden)').length) {
			document.querySelectorAll('.ec-elm').forEach(item => item.classList.remove('hidden'))
		} else {
			document.querySelectorAll('.ec-elm').forEach(item => item.classList.add('hidden'))
		}
		
		showHideNoItemsFound()
	}

	
	let tempCounter = 0
	document.querySelectorAll('.locked-items-wrapper .showcase-item').forEach(item => {
		if (item.classList.contains('hidden') !== true) {
			if (tempCounter < 4) {
				item.classList.add('first-row')
			}
		}
		tempCounter++
	})

	document.querySelectorAll('.--js-showcase-platform').forEach(item => {
		item.addEventListener('click', function () {
			const platformValue = this.getAttribute('data-value')
			const availableTags = this.getAttribute('data-tags').split(',')
			const platformLabel = this.querySelector('span').textContent

			document.querySelectorAll('.--js-showcase-platform').forEach(option => {
				option.classList.remove('font-bold')
				option.querySelector('i').classList.add('hidden')
			})

			item.classList.add('font-bold')
			item.querySelector('i').classList.remove('hidden')

			item.closest('section').querySelector('.selected-platform').textContent = platformLabel
			item.closest('section').querySelector('.platform-wrapper').classList.remove('show-options')

			document.querySelectorAll('.filter-options .--js-showcase-types').forEach(type => {
				const currentType = type.getAttribute('data-value')
				type.classList.remove('active')

				if (availableTags.includes(currentType)) {
					type.classList.remove('hidden')
				} else {
					type.classList.add('hidden')
				}
			})

			setSelectedTypes('')
			setSelectedPlatform(platformValue)

			// Get the current URL parameters
			// var urlParams = new URLSearchParams(window.location.search);

			// remove types
			var urlParams = new URLSearchParams();

			if (platformValue && platformValue !== 'all') {
				urlParams.set('platform', platformValue);
			} else {
				urlParams.delete('platform');
			}

			// Update the URL with the new parameters
			var newUrl = window.location.origin + window.location.pathname + '?' + urlParams.toString();

			// Optionally, update the page URL
			window.history.replaceState(null, null, newUrl);
		})
	})


	document.querySelectorAll('.--js-showcase-types').forEach(item => {
		item.addEventListener('click', function () {
			const typeValue = this.getAttribute('data-value')
			const typeLabel = this.textContent


			// Get the current URL parameters
			var urlParams = new URLSearchParams(window.location.search);

			const currentParamValue = (urlParams.get('types') || '').trim()


			let newValue = ''
			if (this.classList.contains('active')) {
				// remove filter
				newValue = currentParamValue.split(',').filter(item => item !== typeValue).join(',')
				this.classList.remove('active')
			} else {
				// add filter
				if (currentParamValue) {
					newValue = [...currentParamValue.split(','), typeValue].join(',')	
				} else {
					newValue = [typeValue].join(',')
				}
				
				this.classList.add('active')
			}

			setSelectedTypes(newValue)

			if (newValue) {
				urlParams.set('types', newValue);
			} else {
				urlParams.delete('types');
			}

			// Update the URL with the new parameters
			var newUrl = window.location.origin + window.location.pathname + '?' + urlParams.toString();

			// Optionally, update the page URL
			window.history.replaceState(null, null, newUrl);
		})
	})


	const dropdowns = document.querySelectorAll('.platform-dropdown');

	dropdowns.forEach(item => {
	// Add click event listener to the dropdown element
	item.addEventListener('click', function(event) {
		event.stopPropagation(); // Prevent click inside the dropdown from propagating
		this.closest('.platform-wrapper').classList.toggle('show-options');
	});
	});

	// Add a click event listener to the document
	document.addEventListener('click', function(event) {
	// If click is outside of any .platform-dropdown element
	dropdowns.forEach(item => {
		if (!item.contains(event.target)) {
		item.closest('.platform-wrapper').classList.remove('show-options'); // Hide dropdown or perform other actions
		}
	});
	});

	document.querySelectorAll('.show-all-filter').forEach(item => {
		item.addEventListener('click', function () {
			const displayedAll = this.parentNode.classList.contains('show-all')

			if (displayedAll) {
				this.closest('section').querySelector('.filter-wrapper').classList.remove('show-all')
				this.parentNode.classList.remove('show-all')
			} else {
				this.closest('section').querySelector('.filter-wrapper').classList.add('show-all')
				this.parentNode.classList.add('show-all')
			}

		})
	})

	document.querySelectorAll('.show-contact-modal').forEach(item => {
		item.addEventListener('click', function (e) {
			e.preventDefault()
			document.querySelector('.contact-modal').classList.remove('show-success')
			document.querySelector('body').classList.add('open-contact-modal')
			handleModalIndex(true)
			return false
		})
	})
	document.querySelectorAll('a[href="#contact"], [data-popup="contact"]').forEach(item => {
		const formToShow = item.getAttribute('data-form') || 'General Enquiry'
		item.addEventListener('click', function (e) {
			e.preventDefault()

			const tabLink = document.querySelector(`.form-item[data-form="${formToShow}"]`)
			const selectForm = document.querySelector('select.forms')
			if (tabLink) {
				const dataIndex = tabLink.getAttribute('data-index') || 1
				if (selectForm) {
					selectForm.value = dataIndex
				}
				const formElm = tabLink.closest('.contact-forms').querySelector(`.forms [data-index="${dataIndex}"] form`)
				if (formElm) {
					const messageField = formElm.querySelector('[name="message"]')
					if (messageField) {
						messageField.value = item.getAttribute('data-form-message') || '';
					}
				}

				tabLink.click();
				document.querySelector('body').classList.add('open-contact-modal')

				handleModalIndex(true)
			}
			return false
		})
	})


	// Function to check if current scroll position is highest
	function checkHighestScroll() {
		const bodyElm = document.querySelector('body');
		if (window.scrollY === 0) {
		bodyElm.classList.add('scrolled-top')
		bodyElm.classList.remove('scrolled')
		} else {
		bodyElm.classList.add('scrolled')
		bodyElm.classList.remove('scrolled-top')
		}
	}

	// Event listener for scroll
	window.addEventListener('scroll', () => {
		checkHighestScroll();
	});

	// Event listener for resize
	window.addEventListener('resize', () => {
	// Recalculate highest scroll position on resize
		checkHighestScroll();
	});

	// Initial check
	checkHighestScroll();

	document.querySelectorAll('.menu-item-has-children').forEach(item => {
		item.querySelector('a').addEventListener('click', function (e) {
			e.preventDefault()
			document.querySelectorAll('.menu-item-has-children').forEach(otherMenu => {
				if (otherMenu !== item) {
				otherMenu.classList.remove('opened');
				}
			})

			item.classList.toggle('opened')
			return false
		})
	})


	function calculateScrollPercentage(wholenumber = true) {
		const scrollTop = window.scrollY || window.pageYOffset;
		const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		const scrolled = (scrollTop / scrollHeight);
		return scrolled / (wholenumber ? 100 : 1);
	}

	function adjustPortal () {
		const scolledTo = calculateScrollPercentage(false)
		const portalScroll = 100 * scolledTo;
		// document.querySelector('.portal-wrapper').style.top = `-${portalScroll * 1}vh`
	}

	function setCarouselTextColumnHeight() {
		const viewportWidth = window.innerWidth;

		document.querySelectorAll('.slider-v2 .text-column').forEach(item => {
			item.querySelectorAll('.slide-timer').forEach(timer => timer.removeAttribute('style'))

			if (viewportWidth >= 1024) {
				let height = 0
				item.querySelectorAll('[data-slide]').forEach(slide => {
					if (slide.offsetHeight > height) {
						height = slide.offsetHeight
						item.style.height = `${height}px`
					}
				})
			} else {
				item.removeAttribute('style')
			}
		})


		document.querySelectorAll('[data-type="testimonials"][data-with-video="false"]').forEach(item => {
			let height = 0
			item.querySelectorAll('[data-slide]').forEach(slide => {
				if (slide.offsetHeight > height) {
					height = slide.offsetHeight
				}
			})

			item.querySelector('.testimonial-wrapper').style.height = `${height}px`
		})
	}

	function screenResized () {
		adjustPortal();
		setCarouselTextColumnHeight()
	}

	setCarouselTextColumnHeight()

	function documentScrolled () {
		adjustPortal();
	}


	const slideTimerSpeed = 7000 // in millisec

	let timeoutHandler = {};
	let initialPositionTimeout = {};
	let slideRightTimeout = {};
	let timerTimeoutHandler;

	const stopAutoSlide = function (slider, index, goTo) {

		if ( timeoutHandler[index] ) {
			clearTimeout( timeoutHandler[index] );
		}
		slider.removeAttribute('autoplay')
	}

	const carouselSlideTo = function (n, theSlider, index, btnClicked = 0) {
		if(+theSlider.getAttribute( 'data-current-slide' ) === +n) {
			return
		}

		const autoSlide = theSlider.hasAttribute('autoplay') // `${theSlider.getAttribute('data-type')}` !== 'testimonials'
		const markActiveOnly = `${theSlider.getAttribute('data-type')}` === 'testimonials'
		const totalItems = +theSlider.getAttribute('data-count')
		
		if ( initialPositionTimeout[index] ) {
			clearTimeout( initialPositionTimeout[index] );
		}
		if ( slideRightTimeout[index] ) {
			clearTimeout( slideRightTimeout[index] );
		}
		if ( timerTimeoutHandler ) {
			clearTimeout( timerTimeoutHandler );
		}
		if ( timeoutHandler[index] ) {
			clearTimeout( timeoutHandler[index] );
		}
		
		const currentSlide = +theSlider.getAttribute( 'data-current-slide' );
		theSlider.setAttribute('data-current-slide', n)

		// updates slides
		theSlider.querySelectorAll(`[data-slide="${currentSlide}"]`).forEach(slide => {
			slide.classList.remove('initial-position', 'active')

			setTimeout( function () {
				// move image to initial position after hiding
				slide.classList.add('initial-position')
			}, btnClicked > 0 ? 1000 : slideTimerSpeed)
		})

		theSlider.querySelectorAll(`[data-slide="${n}"]`).forEach(slide => {
			slide.classList.add('active')
		})


		const theTimers = theSlider.querySelectorAll('.slide-timer')
		
		theTimers.forEach((xTimer, identifier) => {
			// setActiveLine(index, xTimer, identifier, +n, markActiveOnly, slideTimerSpeed - 2000)

			const siblingElm = xTimer.querySelectorAll('[data-slide-timer]')
			const len = siblingElm.length

			const nextIndex = (+n + 1) > len ? 1 : +n + 1
			const prevIndex = (+n - 1) < 1 ? len : +n - 1
			
			const nextElm = siblingElm[nextIndex - 1]
			const prevElm = btnClicked === 2 ? nextElm : siblingElm[prevIndex - 1]

		// const prevElement = xTimer.parentNode.querySelector(`[data-slide-timer="${+n - 1}"]`) || xTimer.parentNode.querySelector(`[data-slide-timer="${theTimers.length}"]`)

			setActiveLine(index, xTimer, identifier, +n, markActiveOnly, slideTimerSpeed / 2, nextElm, prevElm)
		})
		
		if (autoSlide) {
			timeoutHandler[index] = setTimeout( function() {
				let nextSlide = n + 1;

				if ( nextSlide > totalItems) {
					nextSlide = 1;
				}

				carouselSlideTo( nextSlide, theSlider, index, false );
			}, slideTimerSpeed / 2);
		}
	}


	let timerTimeout = {};

	const setActiveLine = (sliderIndex, timerWrapper, timerIdentifier, active, markActiveOnly = false, slideRightTimeout = 0, nextElm = null, prevElm = null) => {
		// clear all timer timeouts
		Object.keys(timerTimeout).forEach(timeOutIdentifier => {
			clearTimeout(timerTimeout[timeOutIdentifier])
		})


		timerWrapper.querySelectorAll('[data-slide-timer]').forEach(timer => {
			const timerLine = +timer.getAttribute('data-slide-timer')

			if (markActiveOnly) {
				if (timerLine === active) {
					timer.classList.add('active')
				} else {
					// timer.classList.remove('active', 'fake')
					timer.classList.remove('active')
				}
			} else {
				if (timer !== prevElm) {
					timer.classList.remove('active', 'slide-right')
					// timer.classList.add('fake')
				}
				if (+active === +timerLine) {
					// timer.classList.remove('fake')
					timer.classList.add('active')
					prevElm.classList.add('slide-right')
					timerTimeout[`${sliderIndex}${timerIdentifier}${timerLine}`] = setTimeout(function() {
						// timer.classList.add('slide-right')
						prevElm.classList.remove('slide-right', 'active')
					}, slideRightTimeout)
					// timerTimeout[`${sliderIndex}${timerIdentifier}`] = setTimeout(function() {
					// 	timer.classList.remove('active', 'slide-right')
					// 	// timer.classList.add('fake')
					// }, slideTimerSpeed + slideRightTimeout )
				} else if (timer === prevElm) {
					// timer.classList.remove('active', 'fake')
					timerTimeout[`${sliderIndex}${timerIdentifier}${timerLine}`] = setTimeout(function() {
						timer.classList.remove('active', 'slide-right')
					}, slideRightTimeout)
				}
			}
		})
	}

	// slider carousel - v2
	document.addEventListener('DOMContentLoaded', function() {
		// document.querySelectorAll('.contact-modal').forEach(item => {	
		// 	if (item.hasAttribute('hidden')) {
		// 		item.removeAttribute('hidden')
		// 	}
		// })

		document.querySelectorAll('.slider-v2').forEach((slider, index) => {

			// slider.querySelectorAll('.invisible').forEach(invisibleMarker => {
			// 	if (invisibleMarker.classList.contains('previous')) {
			// 		invisibleMarker.addEventListener('click', function () {
			// 			slider.querySelector('.timer-wrapper .prev').click()
			// 		})
			// 	} else if (invisibleMarker.classList.contains('next')) {
			// 		invisibleMarker.addEventListener('click', function () {
			// 			slider.querySelector('.timer-wrapper .next').click()
			// 		})
			// 	}
			// })

			const totalItems = +slider.getAttribute('data-count')
			const firstTimer = slider.querySelectorAll('[data-slide-timer="1"]')

			slider.querySelectorAll('.next').forEach(nextBtn => {
				nextBtn.addEventListener('click', function() {
					slider.setAttribute('autoplay', '')
					const currentSlide = +slider.getAttribute( 'data-current-slide' );
					let nextSlide = currentSlide + 1;

					if ( nextSlide > totalItems) {
						nextSlide = 1;
					}

					carouselSlideTo( nextSlide, slider, index, 1);
				})
			})
			
			slider.querySelectorAll('.prev').forEach(prevBtn => {
				prevBtn.addEventListener('click', function() {
					slider.setAttribute('autoplay', '')
					const currentSlide = +slider.getAttribute( 'data-current-slide' );
					let prevSlide = currentSlide - 1;

					if ( prevSlide < 1) {
						prevSlide = totalItems;
					}

					carouselSlideTo( prevSlide, slider, index, 2);
				})
			})

			slider.querySelectorAll('.clickable').forEach(item => {
				const timer = item.closest('.timer')

				if (timer) {
					item.addEventListener('click',  function () {
						const goTo = +timer.getAttribute('data-slide-timer')
						slider.removeAttribute('autoplay')
						carouselSlideTo(goTo, slider, index)
					})
				}
			})


			// Add touch event listeners for swipe detection
			let startX = 0;
			let endX = 0;

			slider.addEventListener('touchstart', (e) => {
				startX = e.touches[0].clientX;
			}, false);

			slider.addEventListener('touchmove', (e) => {
				endX = e.touches[0].clientX;
			}, false);

			slider.addEventListener('touchend', () => {
				let goTo = +slider.getAttribute( 'data-current-slide' );
				
				if (startX > endX + 50) { // Swipe left
					goTo = goTo + 1
					if ( goTo > totalItems) {
						goTo = 1;
					}
					slider.removeAttribute('autoplay')
					carouselSlideTo(goTo, slider, index)
				} else if (startX < endX - 50) { // Swipe right
					goTo = goTo - 1
					if ( goTo < 1) {
						goTo = totalItems;
					}
					slider.removeAttribute('autoplay')
					carouselSlideTo(goTo, slider, index)
				}
			}, false);

			carouselSlideTo( 1, slider, index );
		})


		window.addEventListener('resize', function(event) {
			screenResized();
		});
		window.addEventListener('scroll', function() {
			documentScrolled();
		});

		document.querySelectorAll('.contact-forms .tabs [data-index]').forEach(item => {
			const formWrapper = item.closest('.contact-forms')

			item.addEventListener('click', function () {
				const index = item.getAttribute('data-index')

				formWrapper.querySelectorAll('.forms [data-index]').forEach(form => {
					form.classList.add('hidden')
				})
				formWrapper.querySelectorAll('.tabs [data-index]').forEach(form => {
					form.classList.remove('active')
				})

				item.classList.add('active')

				const theForm = formWrapper.querySelector(`.forms [data-index="${index}"]`)
				if (theForm) {
					theForm.classList.remove('hidden')
				}
			})
		})


		document.querySelectorAll('.--js-content-height').forEach(item => {
			let contentHeight = 0

			item.parentNode.querySelectorAll('.slide-image').forEach(content => {
				if (contentHeight < content.offsetHeight) {
					contentHeight = content.offsetHeight

					item.style.height = contentHeight + 'px'
				}
			})
		})

		document.querySelectorAll('section.showcase-wrapper').forEach(showcaseSection => {
			
		})


		document.querySelectorAll('section.showcase-wrapper .items-wrapper').forEach(showcaseItems => {
			let isDown = false;
			let startX;
			let scrollLeft;

			showcaseItems.addEventListener('mousedown', (e) => {
				isDown = true;
				showcaseItems.classList.add('active');
				startX = e.pageX - showcaseItems.offsetLeft;
				scrollLeft = showcaseItems.scrollLeft;
			});

			showcaseItems.addEventListener('mouseleave', () => {
				isDown = false;
				showcaseItems.classList.remove('active');
			});

			showcaseItems.addEventListener('mouseup', () => {
				isDown = false;
				showcaseItems.classList.remove('active');
			});

			showcaseItems.addEventListener('mousemove', (e) => {
				if (!isDown) return;
				e.preventDefault();
				const x = e.pageX - showcaseItems.offsetLeft;
				const walk = (x - startX) * 2; //scroll-fast
				showcaseItems.scrollLeft = scrollLeft - walk;
			});
		})

		document.querySelectorAll('a[locked]').forEach(item => {
			item.addEventListener('click', function (e) {
				e.preventDefault()
				document.querySelector('body').classList.add('open-locked-modal')
				return false;
			})
		})

		document.addEventListener('keydown', function(event) {
			const openModalClasses = [
				'open-contact-modal',
				'open-locked-modal'
			]


			if (event.keyCode === 27) {
				document.querySelector('body').classList.remove('open-contact-modal', 'open-locked-modal')
				handleModalIndex(false)

				// document.querySelectorAll(`.${openModalClasses.join(', .')}`).forEach(element => {
				// 	openModalClasses.forEach(item => {
				// 		element.classList.remove(item)
				// 	})
				// })
			}
		});

		document.querySelectorAll('[data-blogs]').forEach(item => {
			const loadMore = item.querySelector('.load-more')
			const itemsPerPage = item.getAttribute('data-items-per-page')
			const blogList = item.querySelector('.blog-list')
			const postTypes = (item.getAttribute('data-posttype') || 'post').split(',')
			if (loadMore) {
				loadMore.addEventListener('click', function (e) {
					e.preventDefault()

					loadMore.textContent = 'Loading...'

					let currentPage = +item.getAttribute('data-page')
					if (!currentPage) {
						currentPage = 1
					}

					const endpointURL = `/wp-json/custom/v1/posts/${postTypes.join(',')}?page=${currentPage + 1}&itemsPerPage=${itemsPerPage}`; // Replace with your actual endpoint URL
					fetch(endpointURL).then(r => r.json())
					.then(data => {
						// Create a document fragment
						const fragment = document.createDocumentFragment();
						data.forEach(blogItem => {

							const tempDiv = document.createElement('div');
							tempDiv.innerHTML = blogItem;
							while (tempDiv.firstChild) {
								fragment.appendChild(tempDiv.firstChild);
							}
							blogList.appendChild(fragment)

							loadMore.textContent = 'load more'
							item.setAttribute('data-page', currentPage + 1)
						})

						if (data.length < itemsPerPage) {
							loadMore.parentNode.style.display = 'none'
						}
					})
					.catch(error => {
						console.error('There was a problem with the fetch operation:', error);
					});
					return false
				})
			}
		})
	});

	function getCurrentDate() {
	const date = new Date();

	const year = date.getFullYear();
	const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
	const day = String(date.getDate()).padStart(2, '0');

	return `${year}-${month}-${day}`;
	}

	function mapGeneralEnquiryData (data) {
		const mapping = {
			name: 'short_text',
			business: 'short_text8',
			// phone: 'text0__1',
			email: 'email',
			message: 'long_text',
			date: 'date__1'
		}

		const temp = {}

		Object.keys(mapping).forEach(item => {
			const index = mapping[item]
			if (item === 'email') {
				const emailJson = {}
				emailJson.email = data[item] || ''
				emailJson.text = data[item] || ''
				temp[index] = emailJson
			} else {
				temp[index] = data[item] ? data[item].replace(/'/g, "\\'") : ''
			}
			
		})

		return temp 
	}

	function saveToMonday (formOptions, data, btn = null) {

		const apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjM2MDIwNzg4NiwiYWFpIjoxMSwidWlkIjo2MDk5NjI3NSwiaWFkIjoiMjAyNC0wNS0xNlQwNTozNzoxOC4wMDBaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6OTAyNDYzNiwicmduIjoidXNlMSJ9.QuNR73EnJh4YGnkgA2zqc5TxadPFVUauiCu_WStURqA'; // Replace with your Monday.com API key

		const query = `mutation {create_item (board_id: ${formOptions.board_id}, group_id: \"${formOptions.group_id}\", item_name: \"${formOptions.item_name}\", column_values: "${JSON.stringify(data).replace(/"/g, '\\"').replace(/'/g, "&#39;")}") {id}}`;

		if (btn) {
			btn.textContent = 'Please wait...'
			btn.setAttribute('disabled', true)
		}

		fetch('https://api.monday.com/v2', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'Authorization': apiKey
			},
			body: JSON.stringify({
				query: query
			})
		})
		.then(response => response.json())
		.then(data => {

			if (data.errors) {
				console.error('Error:', data.errors);
			} else {
				document.querySelectorAll('form').forEach(item => item.reset());
				document.querySelector('.contact-modal').classList.add('show-success')
			}
			
			if (btn) {
				btn.textContent = 'Send Message'
				btn.removeAttribute('disabled')
			}
		})
		.catch(error => console.error('Error:', error));
	} 


	function submitGeneralEnquiry (data, btn) {
		const formOptions = {
			board_id: 4389322636,
			group_id: "topics",
			item_name: 'General Enquiry'
		}
		saveToMonday(formOptions, mapGeneralEnquiryData(data), btn)
	}

	function submitBookAFreeUXReview (data, btn) {
		const formOptions = {
			board_id: 4389322636,
			group_id: "topics",
			item_name: 'Book a Free UX Review'
		}
		saveToMonday(formOptions, mapGeneralEnquiryData(data), btn)
	}

	function mapPresentationPackData (data) {
		const mapping = {
			name: 'short_text',
			company: 'short_text4',
			// phone: 'text0__1',
			email: 'email'
		}

		const temp = {}

		Object.keys(mapping).forEach(item => {
			const index = mapping[item]
			if (item === 'email') {
				const emailJson = {}
				emailJson.email = data[item] || ''
				emailJson.text = data[item] || ''
				temp[index] = emailJson
			} else {
				temp[index] = data[item] || ''
			}
			
		})

		temp['status'] = {index: 0}

		return temp
	}
	function mapRequestShowcaseAccessData (data) {

		const mapping = {
			name: 'short_text__1',
			company: 'short_text0__1',
			// phone: 'text0__1',
			email: 'email__1'
		}

		const temp = {}

		Object.keys(mapping).forEach(item => {
			const index = mapping[item]
			if (item === 'email') {
				const emailJson = {}
				emailJson.email = data[item] || ''
				emailJson.text = data[item] || ''
				temp[index] = emailJson
			} else {
				temp[index] = data[item] || ''
			}
			
		})

		temp['status__1'] = {index: 0}

		return temp
		
	}
	function submitRequestShowcaseAccess (data, btn) {
		const formOptions = {
			board_id: 7238484560,
			group_id: "topics",
		item_name: 'Request Showcase Item'
		}
		saveToMonday(formOptions, mapRequestShowcaseAccessData(data), btn)
	}
	function submitPresentationPack (data, btn) {
		const formOptions = {
			board_id: 4389104004,
			group_id: "topics",
		item_name: 'Incoming from Website'
		}
		saveToMonday(formOptions, mapPresentationPackData(data), btn)
	}


	document.querySelectorAll('form').forEach(form => {
		if (form.getAttribute('data-form-name')) {
			form.addEventListener('submit', function(e) {
				e.preventDefault()

				const formData = new FormData(e.target)
				const formValues = Object.fromEntries(formData.entries())
				formValues.date = getCurrentDate()

				const btn = form.querySelector('[type="submit"]')

				switch (form.getAttribute('data-form-name')) {
					case 'general-enquiry':
						submitGeneralEnquiry(formValues, btn)
						break
					case 'free-ux-review':
						submitBookAFreeUXReview(formValues, btn)
						break
					case 'request-showcase-access':
						submitRequestShowcaseAccess(formValues, btn)
						break
					case 'download-presentation-pack':
						submitPresentationPack(formValues, btn)
						break
				}

				return false
			})
		}
	})


	function checkFullPageImagePosition () {
			
		var element = document.querySelector('.fullpage-hero-image');

		if (element) {
			var backgroundImage = new Image();
			backgroundImage.src = getComputedStyle(element).backgroundImage.slice(5, -2);


			backgroundImage.onload = function() {
				var elementWidth = element.clientWidth;
				var aspectRatio = backgroundImage.height / backgroundImage.width;
				var renderedHeight = elementWidth * aspectRatio;
				
				if (renderedHeight < element.clientHeight) {
					element.style.backgroundPosition = 'bottom';
				} else {
					element.style.backgroundPosition = 'top';
				}
			};
		}
	}

	window.addEventListener('load', checkFullPageImagePosition);
	window.addEventListener('resize', checkFullPageImagePosition);


	const handleVideoPlayer = () => {
		document.querySelectorAll('.post-thumbnail .play-button').forEach(item => {
			const wrapper = item.closest('.post-thumbnail')
			item.addEventListener('click', function () {
				wrapper.querySelector('.override-video-thumbnail').style.display = 'none'
				item.style.display = 'none'

				wrapper.querySelectorAll('.video-player iframe').forEach(iframeElm => {
					const iframeSrc = `${iframeElm.getAttribute('src')}`.replace('autoPlay=0', 'autoPlay=1')
					iframeElm.setAttribute('width', '640')
					iframeElm.setAttribute('height', '360')
					iframeElm.closest('.video-player').style.display = 'block'
					iframeElm.setAttribute('src', iframeSrc)
				})

				wrapper.querySelectorAll('video').forEach(video => {
					video.play()
				})
			})
		})
	}

	const handleShowcaseEC = () => {
		document.querySelectorAll('.ec-items').forEach(item => {
			if (item.querySelectorAll('.showcase-item:not(.hidden)').length) {
				item.parentNode.querySelectorAll('.ec-elm').forEach(ec => ec.classList.remove('hidden'))

				if (!document.body.classList.contains('ec-allowed')) {
					item.querySelectorAll('.showcase-item:not(.hidden)').forEach((ecItem, index) => {
						if (index >= 8) {
							ecItem.classList.add('hidden')
						}
					})
				}
			}
		})
	}

	const handleBlogCards = () => {
		document.querySelectorAll('.blog-item').forEach(item => {
			item.addEventListener('click', function () {
				if (window.innerWidth <= 991) {
					const link = item.querySelector('a')
					if (link) {
						window.location.href = link
					}
				}
			})
		})
	}

	const handleMenuClick = () => {
		// document.querySelectorAll('.menu-item-has-children > a').forEach(item => {
		// 	item.addEventListener('click', function (e) {
		// 		e.preventDefault()

		// 		item.closest('ul').querySelectorAll('.menu-item-has-children a').forEach(menuItem => {
		// 			if (menuItem !== item) {
		// 				menuItem.closest('li').classList('show-sub-menu')
		// 			}
		// 		})
		// 		item.closest('li').classList.toggle('show-sub-menu')
		// 		return;
		// 	})
		// })
	}

	const handleModalIndex = (show = false, modalSelector = '.contact-modal') => {
		if (show) {
			document.querySelectorAll(modalSelector).forEach(item => item.style.zIndex = 150)
		} else {
			setTimeout(function () {
				document.querySelectorAll(modalSelector).forEach(item => item.style.zIndex = -1000)
			}, 1000)
		}
	}

	window.addEventListener( 'DOMContentLoaded', function() {
		handleVideoPlayer()
		handleShowcaseEC()
		handleBlogCards()
		handleMenuClick()
	});