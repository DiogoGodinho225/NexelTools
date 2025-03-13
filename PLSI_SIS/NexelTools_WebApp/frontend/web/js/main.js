(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
    
})(jQuery);

function abrirChat(user1_id, user2_id) {
    var chat = document.querySelector('.chat-view');
    var produtoView = document.querySelector('.produto-view');
    
    var overlay = document.querySelector('.overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.classList.add('overlay');
        produtoView.appendChild(overlay); 
    }

    console.log(user1_id);
    console.log(user2_id);
    document.body.style.overflow = 'hidden'; 

    $.ajax({
        url: '/chat/view',
        method: 'GET',
        data: {
            user1_id: user1_id,
            user2_id: user2_id,
        },
        success: function (data) {
            chat.innerHTML = data; 
            chat.style.display = 'block'; 
            chat.classList.add('show'); 
            overlay.classList.add('show'); 
            overlay.style.display = 'block';
        }
    });

    overlay.addEventListener("click", function (event) {
        if (!document.querySelector(".chat-container").contains(event.target)) {
            fecharChat();
        }
    });
}

function alterarEstado(inputText) {
    const btnEnviar = document.querySelector('.btn-send-message');

    if (inputText.value == '') {
        btnEnviar.disabled = true;
        inputText.placeholder = 'Escreva uma mensagem...';
    } else {
        btnEnviar.disabled = false;
    }
}

function fecharChat() {
    var chat = document.querySelector(".chat-view");
    var overlay = document.querySelector(".overlay");

    chat.classList.remove('show');
    overlay.classList.remove('show');    
    chat.style.display = "none";
    overlay.style.display = "none";
    document.body.style.overflow = 'auto'; 
}
