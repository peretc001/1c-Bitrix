BX.ready(function() {
    $('.tags-hide').on('click', function() {
        $('.tags-hide').toggleClass('active')
        $('.tags-items').toggleClass('active')
    })

    // Смена ТЕГОВ
    let current = document.querySelector('.js-tags.active') ? document.querySelector('.js-tags.active').dataset.id : 0;
    let tags = '';
    let H1 = document.querySelector('h1');
    const defaultH1 = 'Блог';

    const tagList = document.querySelectorAll('.js-tags')
    tagList.forEach(item => {

        item.addEventListener('click', () => {

            if (current === 0)
            {
                if (document.querySelector('.js-tags.active'))
                    document.querySelector('.js-tags.active').classList.remove('active')

                item.classList.add('active')
                H1.textContent = item.dataset.title
                tags = item.dataset.title
                current = item.dataset.id
                history.pushState({ page: item.dataset.id }, item.dataset.title, "?tags="+ item.dataset.title)
            }
            else if (current === item.dataset.id) {
                if (document.querySelector('.js-tags.active'))
                    document.querySelector('.js-tags.active').classList.remove('active')

                H1.textContent = defaultH1
                tags = ''
                current = 0
                history.pushState("", "", "/articles/");
            }
            else {
                if (document.querySelector('.js-tags.active'))
                    document.querySelector('.js-tags.active').classList.remove('active')

                item.classList.add('active')
                H1.textContent = item.dataset.title
                tags = item.dataset.title
                current = item.dataset.id
                history.pushState({ page: item.dataset.id }, item.dataset.title, "?tags="+ item.dataset.title)
            }

            const BLOG = document.querySelector('.blog')
            BLOG.classList.add('preloader')
            $.ajax({
                url: "/ajax/blog.php",
                type: 'post',
                dataType: "text",
                data: {
                    tags: tags
                },
                success: function (response) {
                    BLOG.innerHTML = response
                    setTimeout(()=>{
                        BLOG.classList.remove('preloader')
                    },200)
                }
            });
        })
    })
})
