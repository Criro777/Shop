/*price range*/

$('#sl2').slider();

function fireSubmit(event) {
    $('#formMoney').submit();
}



/*----------------Ajax-функции для работы с контактами---------------*/


$("#main-contact-form").validator().on("submit", function (e) {
//
    if (e.isDefaultPrevented()) {

        //submitMSG(false, "Did you fill in the form properly?");

    } else {
        // everything looks good!
        e.preventDefault();
        submitForm();
    }
});

function submitForm() {
// Переменные с данными из формы
    var name    = $("#name").val();
    var email   = $("#email").val();
    var subject = $("#subject").val();
    var message = $("#message").val();
    $.ajax({
        type: "POST",
        url: "/site/message",
        data: "name=" + name + "&email=" + email + "&message=" + message,
        success: function (data) {
            if (data == "success") {

                $("#msgSubmit").removeClass("hidden");
                $("#main-contact-form")[0].reset();
            }
        }
    });
}

function submitMSG(valid, msg) {
    if (valid) {
        var msgClasses = "alert alert-success";
    } else {
        var msgClasses = "alert alert-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);

}
/*----------------------------Карта Google----------------------------*/

function initialize() {
    var myLatlng = new google.maps.LatLng(53.3333, -3.08333),
        mapOptions = {
            zoom: 11,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
    var map = new google.maps.Map(document.getElementById('map'), mapOptions),
        contentString = 'Some address here..',
        infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 500
        });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
    });
    google.maps.event.addDomListener(window, "resize", function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);


/*--------------------------Скроллинг страницы------------------------*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
    /*--------------------------Плагин галереи------------------------*/

    $(".gallery a").lightBox({
        overlayBgColor: '#f6f6f6',
        overlayOpacity: 0.6,
        imageLoading: '/public/images/light/loading.gif',
        imageBtnClose: '/public/images/light/close2.png',
        imageBtnPrev: '/public/images/light/prev.png',
        imageBtnNext: '/public/images/light/next.png',
        containerResizeSpeed: 350,
        txtImage: 'Изображение',
        txtOf: 'из'
    });

    /*------------------Аккордеон для дерева категорий----------------*/

    $(".category-products").dcAccordion();


    /*------------------------Рейтинг в звёздах-----------------------*/

    var isVoted = false;

    if($(".area").hasClass('disabled')) {

        isVoted = true;
    }
    $(".area").jRating({

        showRateInfo: true,
        smallStarsPath:'/public/icons/small.png',
        bigStarsPath:'/public/icons/stars.png',
        phpPath: '/blog/add-rate/',
        step: true,
        rateMax: 10,
        type: 'big', // показать маленькие звезды, а не большие по умолчанию);
        isDisabled: isVoted
    });

    /*-------------------Функции для работы с корзиной----------------*/

    $(".add-to-cart").click(function () {
        var params = {
            quantity: $("#quantity").val(),
        }
        var id = $(this).attr("id");
        $.post("/cart/add/" + id, params, function (data) {
            showCount(data);
        });
        return false;
    });
    function showCount(data) {
        $("#cart-count").html(data);
    }


    $("#clear-all").click(function () {
        $.post("/cart/clear", {}, function (data) {
            $("#cart_section").html(data);
            getQty();
        });
    });

    $(".delete-item").click(function () {
        var id = $(this).attr("id");
        $.post("/cart/delete/" + id, {}, function (data) {
            $("#cart_section").html(data);
            getQty();
        });
    });

    function getQty() {

        $.post("/cart/count/", {}, function (data) {
            $("#cart-count").html(data);
        });
    }


});
