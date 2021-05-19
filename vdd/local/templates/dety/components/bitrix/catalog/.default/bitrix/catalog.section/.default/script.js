//TODO  Сделать мин версию скрипта
document.addEventListener("DOMContentLoaded", function() {

	const   div = document.createElement('div');
	div.classList.add('layout')

	//Sort block
	if ( document.querySelector('.products-sort-block--select') ) {
		const   dropDown = document.querySelector('.products-sort-block--select')
		dropDownMenu = document.querySelector('.products-sort-block--options')

		function closeDropDownEvent(event) { event.target = div ? closeDropDown() : '' }

		const   openDropDown = () => {
			dropDownMenu.classList.add('fade')
			setTimeout(() => {
				dropDownMenu.classList.add('active')
			}, 100);
			dropDown.classList.add('active')
			document.body.append(div)
			div.addEventListener('click', closeDropDownEvent)
		}
		closeDropDown = () => {
			dropDownMenu.classList.remove('active')
			setTimeout(() => {
				dropDownMenu.classList.remove('fade')
			}, 100);
			dropDown.classList.remove('active')
			document.body.removeChild(div)
			div.removeEventListener('click', closeDropDownEvent)
		}

		dropDown.addEventListener('click', openDropDown)
	}

	//Show Hide SmartFilter
	if ( document.querySelector('.products-sort .open-filter') ) {
		const   productsFilter = document.querySelector('.products-filter')
		openFilter = document.querySelector('.products-sort .open-filter')

		function closeSmartFilterEvent(event) { event.target = div ? closeSmartFilter() : '' }

		const   openSmartFilter = () => {
			productsFilter.classList.add('fade')
			setTimeout(() => {
				productsFilter.classList.add('active')
			}, 100);
			openFilter.classList.add('active')
			document.body.append(div)
			div.addEventListener('click', closeSmartFilterEvent)
		}
		closeSmartFilter = () => {
			productsFilter.classList.remove('active')
			setTimeout(() => {
				productsFilter.classList.remove('fade')
			}, 100);
			openFilter.classList.remove('active')
			document.body.removeChild(div)
			div.removeEventListener('click', closeSmartFilterEvent)
		}

		openFilter.addEventListener('click', openSmartFilter)
	}
});