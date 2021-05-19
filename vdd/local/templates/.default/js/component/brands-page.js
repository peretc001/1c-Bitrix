BX.ready(function() {
    //Brands page
    if (document.querySelector('.brands-header__favorite')) {
        const   favorite = document.querySelector('.brands-header__favorite')
        btn1 = favorite.children[0]
        btn2 = favorite.children[1]

        btn1.addEventListener('click', function() {
            favorite.classList.add('active')
            document.querySelector('.brands-list').classList.add('active')
            document.querySelector('.brands-all').classList.remove('active')
        })
        btn2.addEventListener('click', function() {
            favorite.classList.remove('active')
            document.querySelector('.brands-list').classList.remove('active')
            document.querySelector('.brands-all').classList.add('active')
        })

        const alphabet = document.querySelectorAll('.brands-alphabet span'),
            findBrand = (e) => {
                function findBrand(id) {
                    const allAnchor = document.querySelectorAll('.brands-all-card')
                    const anchor = document.querySelector('[data-card = '+ id +']')
                    allAnchor.forEach(item => {
                        item.style.display = 'none'
                    });
                    anchor.style.display = 'flex'
                }
                if (favorite.classList.contains('active')) {
                    findBrand(e.target.textContent)
                    favorite.classList.remove('active')
                    document.querySelector('.brands-list').classList.remove('active')
                    document.querySelector('.brands-all').classList.add('active')
                } else {
                    findBrand(e.target.textContent)
                }
            };
        alphabet.forEach(item => {
            !item.classList.contains('none') ? item.addEventListener('click', findBrand) : ''
        })
    }
})