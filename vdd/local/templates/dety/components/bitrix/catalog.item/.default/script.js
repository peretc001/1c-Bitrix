BX.ready(function(){
    const addToBasketBtn = document.querySelectorAll('.btn.btn-accent.addBtn');
    const addToBasketPlusBtn = document.querySelectorAll('.addToBasketPlus');
    const addToFavoriteBtn = document.querySelectorAll('.addToFavorite');

    addToBasket = (event) => {
        const cart = document.querySelector('.nav-search .cart');
        const cartQTY = cart.querySelector('.qty');
        const cartTOTAL = cart.querySelector('.total');

        let maxQTY = event.target.closest('.products-card__buy').dataset.maxqty;
        const newBlock = document.createElement('div');
        newBlock.classList.add('inBasket');
        newBlock.innerHTML = `<div class="btn hasBasket">
				<a href="/personal/cart/">В корзине <span>1</span> шт<br>
					<small>Перейти</small>
				</a>
			</div>
			<button class="btn addToBasketPlus" data-id="${event.target.dataset.id}" data-qty="1" ${maxQTY == 1 ? 'disabled' : ''}>+1 шт</button>`

        event.target.parentNode.classList.add('progress')

        $.ajax({
            url: "/ajax/add2basket.php",
            type: 'post',
            data: {
                ID: event.target.dataset.id
            },
            success: function (responce) {
                let data = JSON.parse(responce);
                if(data.status){
                    cartQTY
                        ? cartQTY.textContent = data.count
                        : cart.innerHTML = `<a href="/personal/cart/"><span class="qty">${data.count}</span><span class="total">${data.total.toLocaleString('ru-RU')} ₽</span></a>`;
                    cartTOTAL ? cartTOTAL.textContent = `${data.total.toLocaleString('ru-RU')} ₽` : '';

                    setTimeout(() => {
                        event.target.removeEventListener('click', addToBasket)
                        event.target.parentNode.parentNode.append(newBlock)
                        event.target.parentNode.parentNode.removeChild(event.target.parentNode)
                    }, 500)

                    let addPlusOne = newBlock.querySelector('.addToBasketPlus')
                    addPlusOne.addEventListener('click', addToBasketPlus)
                }
                else
                {
                    console.log('error')
                }
            }
        })
    };

    addToBasketPlus = (event) => {
        const cart = document.querySelector('.nav-search .cart');
        const cartQTY = cart.querySelector('.qty');
        const cartTOTAL = cart.querySelector('.total');

        const qtyBlock = event.target.previousElementSibling
        let count = event.target.dataset.qty
        let maxQTY = event.target.closest('.products-card__buy').dataset.maxqty

        if(maxQTY > count) {
            count++
            qtyBlock.classList.add('progress')

            $.ajax({
                url: "/ajax/add2basket.php",
                type: 'post',
                data: {
                    ID: event.target.dataset.id
                },
                success: function (responce) {
                    let data = JSON.parse(responce);
                    if(data.status){
                        cartQTY ? cartQTY.textContent = data.count : '';
                        cartTOTAL ? cartTOTAL.textContent = `${data.total.toLocaleString('ru-RU')} ₽` : '';

                        setTimeout(() => {
                            qtyBlock.classList.remove('progress')
                            qtyBlock.querySelector('span').textContent = data.qty
                            event.target.dataset.qty = data.qty
                            if(maxQTY == count) event.target.disabled = true
                        }, 1000)
                    }
                    else
                    {
                        console.log('error')
                    }
                }
            });
        } else {
            event.target.disabled = true
        }
    };

    addToBasketBtn.forEach(item => {
        item.addEventListener('click', addToBasket)
    });
    addToBasketPlusBtn.forEach(item => {
        item.addEventListener('click', addToBasketPlus)
    });

    addToFavorite = (event) => {
        $.ajax({
            url: "/ajax/add2favorite.php",
            type: 'post',
            data: {
                ID: event.target.dataset.id,
            },
            success: function (response) {
                data = JSON.parse(response)

                function updateFavorite(num) {
                    const wishlishBlock = document.querySelector('.nav-search--right__wishlist')
                    if(num < 1) {
                        wishlishBlock.classList.contains('active')
                            ? wishlishBlock.classList.remove('active') : ''
                        wishlishBlock.innerHTML = ''
                    } else {
                        !wishlishBlock.classList.contains('active')
                            ? wishlishBlock.classList.add('active') : ''
                        wishlishBlock.innerHTML = `<span>${num}</span>`
                    }
                }

                if(data.status && data.message == 'add') {
                    event.target.classList.add('active')
                    updateFavorite(data.count)
                }
                if(data.status && data.message == 'delete') {
                    event.target.classList.remove('active')
                    updateFavorite(data.count)
                }
                if(!data.status && data.message == 'user') {
                    myModal('login')
                }
            }
        });
    };

    addToFavoriteBtn.forEach(item => {
        item.addEventListener('click', addToFavorite)
    });
});