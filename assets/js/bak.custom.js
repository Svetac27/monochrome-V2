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
			faqAns.style.height = `${faqAns.scrollHeight}px`
			faqAns.closest('li').classList.add('open')
		}
	})
})



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
function filterShowcaseProjects () {
	const validPlatformClass = selectedShowcasePlatform && selectedShowcasePlatform !== 'all' ? `showcase-platform-${selectedShowcasePlatform}` : null
	const validTypeClasses = selectedShowcaseTypes.split(',').filter(item => item).map(item => `showcase-type-${item}`)

	const checkTypeClasses = (elm) => {
		if (!validTypeClasses.length) {
			return true
		}
		for (let i = 0; i < validTypeClasses.length; i++) {
			if (elm.classList.contains(validTypeClasses[i])) {
				return true
			}
		} return false
	}

	document.querySelectorAll('.showcase-item').forEach(item => {
		if (!validPlatformClass) {
			if (checkTypeClasses(item)) {
				item.classList.remove('hidden')
			} else {
				item.classList.add('hidden')
			}
		} else if (item.classList.contains(validPlatformClass)) {
			if (checkTypeClasses(item)) {
				item.classList.remove('hidden')
			} else {
				item.classList.add('hidden')
			}
		} else {
			// not selected platform
			item.classList.add('hidden')
		}
	}) 
}

document.querySelectorAll('.--js-showcase-platform').forEach(item => {
	item.addEventListener('click', function () {
		const platformValue = this.getAttribute('data-value')
		const platformLabel = this.querySelector('span').textContent

		document.querySelectorAll('.--js-showcase-platform').forEach(option => {
			option.classList.remove('font-bold')
			option.querySelector('i').classList.add('hidden')
		})

		item.classList.add('font-bold')
		item.querySelector('i').classList.remove('hidden')

		item.closest('section').querySelector('.selected-platform').textContent = platformLabel

		setSelectedPlatform(platformValue)

	    // Get the current URL parameters
	    var urlParams = new URLSearchParams(window.location.search);

	    // Set the new value for the given key
	    urlParams.set('platform', platformValue);

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


	    // Set the new value for the given key
	    urlParams.set('types', newValue);

	    // Update the URL with the new parameters
	    var newUrl = window.location.origin + window.location.pathname + '?' + urlParams.toString();

	    // Optionally, update the page URL
	    window.history.replaceState(null, null, newUrl);
	})
})


document.querySelectorAll('.platform-dropdown').forEach(item => {
	item.addEventListener('click', function () {
		this.closest('.platform-wrapper').classList.toggle('show-options')
	})
})

document.querySelectorAll('.show-all-filter').forEach(item => {
	item.addEventListener('click', function () {
		this.closest('.filter-wrapper').classList.toggle('show-all')
	})
})

document.querySelectorAll('.show-contact-modal').forEach(item => {
	item.addEventListener('click', function (e) {
		e.preventDefault()
		document.querySelector('body').classList.add('open-contact-modal')
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

const carouselSlideTo = function (n, theSlider, index, btnClicked = false) {
	if(+theSlider.getAttribute( 'data-current-slide' ) === +n) {
		return
	}


	const autoSlide = true // `${theSlider.getAttribute('data-type')}` !== 'testimonials'
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
		}, btnClicked ? 1000 : slideTimerSpeed)
	})

	theSlider.querySelectorAll(`[data-slide="${n}"]`).forEach(slide => {
		slide.classList.add('active')
	})


	theSlider.querySelectorAll('.slide-timer').forEach((xTimer, identifier) => {
		setActiveLine(index, xTimer, identifier, +n, markActiveOnly)
	})

	if (autoSlide) {
		timeoutHandler[index] = setTimeout( function() {
			let nextSlide = n + 1;

			if ( nextSlide > totalItems) {
				nextSlide = 1;
			}

			carouselSlideTo( nextSlide, theSlider, index, false );
		}, slideTimerSpeed);
	}
}


let timerTimeout = {};

const setActiveLine = (sliderIndex, timerWrapper, timerIdentifier, active, markActiveOnly = false) => {
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
				timer.classList.remove('active', 'fake')
			}
		} else {
			if (active === timerLine) {
				timer.classList.remove('fake')
				timer.classList.add('active')
				timerTimeout[`${sliderIndex}${timerIdentifier}`] = setTimeout(function() {
					timer.classList.remove('active')
					timer.classList.add('fake')
				}, slideTimerSpeed)
			} else if (timerLine < active) {
				timer.classList.remove('active')
				timer.classList.add('fake')
			} else if (timerLine > active) {
				timer.classList.remove('active', 'fake')
			}
		}
	})
}

// slider carousel - v2
document.addEventListener('DOMContentLoaded', function() {

	document.querySelectorAll('.slider-v2').forEach((slider, index) => {

		const totalItems = +slider.getAttribute('data-count')
		const firstTimer = slider.querySelectorAll('[data-slide-timer="1"]')

		slider.querySelectorAll('.next').forEach(nextBtn => {
			nextBtn.addEventListener('click', function() {
				const currentSlide = +slider.getAttribute( 'data-current-slide' );
				let nextSlide = currentSlide + 1;

				if ( nextSlide > totalItems) {
					nextSlide = 1;
				}

				carouselSlideTo( nextSlide, slider, index, true);
			})
		})
		
		slider.querySelectorAll('.prev').forEach(prevBtn => {
			prevBtn.addEventListener('click', function() {
				const currentSlide = +slider.getAttribute( 'data-current-slide' );
				let prevSlide = currentSlide - 1;

				if ( prevSlide < 1) {
					prevSlide = totalItems;
				}

				carouselSlideTo( prevSlide, slider, index, true);
			})
		})
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

			formWrapper.querySelector(`.forms [data-index="${index}"]`)?.classList.remove('hidden')
		})
	})


	document.querySelectorAll('.--js-content-height').forEach(item => {
		let contentHeight = 0

		item.parentNode.querySelectorAll('.slide-image').forEach(content => {
			if (contentHeight < content.offsetHeight) {
				contentHeight = content.offsetHeight

				item.style.height = `${contentHeight}px`
			}
		})
	})

	document.querySelectorAll('section.showcase-wrapper').forEach(showcaseSection => {
		/*let scrollTimeout;
		let lastScrollLeft = 0;
		let jsTriggered = false

		showcaseSection.addEventListener('scroll', function() {

			if (jsTriggered) {
				return
			}
			const container = this
		    // Clear the timeout if it has already been set.
		    clearTimeout(scrollTimeout);


		    // Get the current scroll positions
		    let scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

		    const direction = scrollLeft > lastScrollLeft ? 'right' : 'left'

		    console.log(dire)

		    // Update the last scroll positions
		    lastScrollLeft = scrollLeft;





		    // Set a timeout to run after scrolling ends.
		    scrollTimeout = setTimeout(function() {
		      jsTriggered = true
		      
		      let scrollPosition = container.scrollLeft;
		      let containerCenter = container.offsetWidth / 2;

		      const currentPosition = container.querySelector('.items-wrapper').offsetLeft
		      const childWidth = container.querySelector('.items-wrapper').scrollWidth
		      const itemWidth = container.querySelector('.items-wrapper img').offsetWidth + 30 // 30 is margin
		      const numberOfItems = Math.round(childWidth / itemWidth)

		      const firstChildPosition = container.querySelector('.items-wrapper :first-child').offsetLeft
		      const lastChildPosition = container.querySelector('.items-wrapper :last-child').offsetLeft

		      let itemsToHide
		      if (direction === 'right') {
		      	itemsToHide = Math.ceil(scrollPosition / itemWidth)
		      } else {
		      	itemsToHide = Math.floor(scrollPosition / itemWidth)
		      }

		      container.scrollLeft = `${itemsToHide * itemWidth}px`

		      console.log(scrollPosition, itemsToHide, itemWidth, direction, `${itemsToHide * itemWidth}px`)

		      setTimeout(function() {
		      	jsTriggered = false
		      }, 100)
		    }, 500); // Adjust the time as needed, this is in milliseconds.
		});*/
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
	    	console.log('escaped')
	    	document.querySelectorAll(`.${openModalClasses.join(', .')}`).forEach(element => {
	    		openModalClasses.forEach(item => {
	    			element.classList.remove(item)
	    		})
	    	})
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

function addslashes(str) {
return (str + '')
    .replace(/[\\"']/g, '\\$&')
    .replace(/\u0000/g, '\\0');
}

function getCurrentDate() {
const date = new Date();

const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
const day = String(date.getDate()).padStart(2, '0');

return `${year}-${month}-${day}`;
}

function mapGeneralEnquiryData (data) {
const mapping = {
	name: 'text42__1',
	business: 'text__1',
	phone: 'text0__1',
		message: 'text4__1',
		date: 'date__1'
	}

	Object.keys(mapping).forEach(item => {
		const index = mapping[item]
		data[index] = data[item] || ''
	})

	return data 
}

function saveToMonday (formOptions, data) {

    const apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjM2MDIwNzg4NiwiYWFpIjoxMSwidWlkIjo2MDk5NjI3NSwiaWFkIjoiMjAyNC0wNS0xNlQwNTozNzoxOC4wMDBaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6OTAyNDYzNiwicmduIjoidXNlMSJ9.QuNR73EnJh4YGnkgA2zqc5TxadPFVUauiCu_WStURqA'; // Replace with your Monday.com API key

    const query = `
        mutation {
            create_item (
                board_id: ${formOptions.board_id}, 
                group_id: \"${formOptions.group_id}\",
                item_name: \"${formOptions.item_name}\",
                column_values: "${addslashes(JSON.stringify(data))}"
            ) {
                id
            }
        }
    `;

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
            console.log('Success:', data);
            alert('Form submitted successfully!');
        }
    })
    .catch(error => console.error('Error:', error));
} 


function submitGeneralEnquiry (data) {
	const formOptions = {
		board_id: 6651261193,
 	    group_id: "general_enquiry__1",
		item_name: data.email
	}
	saveToMonday(formOptions, mapGeneralEnquiryData(data))
}

function submitBookAFreeUXReview (data) {
	const formOptions = {
		board_id: 6651261193,
 	    group_id: "group_title",
		item_name: data.email
	}
	saveToMonday(formOptions, mapGeneralEnquiryData(data))
}


document.querySelectorAll('form').forEach(form => {
	if (form.getAttribute('data-form-name')) {
		form.addEventListener('submit', function(e) {
			e.preventDefault()

		    const formData = new FormData(e.target)
		    const formValues = Object.fromEntries(formData.entries())

			switch (form.getAttribute('data-form-name')) {
				case 'general-enquiry':
					formValues.date = getCurrentDate()
					submitGeneralEnquiry(formValues)
					break
				case 'free-ux-review':
					formValues.date = getCurrentDate()
					submitBookAFreeUXReview(formValues)
					break
			}

			return false
		})
	}
})

/*


GROUPS
                    {
                        "id": "general_enquiry__1",
                        "title": "General Enquiry"
                    },
                    {
                        "id": "group_title",
                        "title": "Book a Free UX Review"
                    },
                    {
                        "id": "new_group__1",
                        "title": "Request Showcase Access"
                    },
                    {
                        "id": "new_group32202__1",
                        "title": "Get a Quote"
                    },
                    {
                        "id": "new_group46529__1",
                        "title": "Join Waiting List"
                    }


{
                "columns": [
                    {
                        "id": "name",
                        "title": "Name",
                        "type": "name"
                    },
                    {
                        "id": "person",
                        "title": "Name",
                        "type": "people"
                    },
                    {
                        "id": "text__1",
                        "title": "Business",
                        "type": "text"
                    },
                    {
                        "id": "text0__1",
                        "title": "Phone",
                        "type": "text"
                    },
                    {
                        "id": "text4__1",
                        "title": "Message",
                        "type": "text"
                    },
                    {
                        "id": "date4",
                        "title": "Date",
                        "type": "date"
                    },
                    {
                        "id": "status",
                        "title": "Status",
                        "type": "status"
                    }
                ]
            }
            */
