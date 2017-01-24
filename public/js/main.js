/*price range*/

$('#sl2').slider();

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*$("#login").submit(function(event){
// cancels the form submission
    event.preventDefault();
    $("#login")[0].reset();
});*/

function fireSubmit(event) {
    $('#formMoney').submit();
}


$(document).ready(function () {
    $(".category-products").dcAccordion();
});

$(document).ready(function () {
    $(".gallery a").lightBox({
        overlayBgColor: '#f6f6f6',
        overlayOpacity: 0.6,
        imageLoading: '/public/images/light/loading.gif',
        imageBtnClose: '/public/images/light/close.gif',
        imageBtnPrev: '/public/images/light/prev.gif',
        imageBtnNext: '/public/images/light/next.gif',
        containerResizeSpeed: 350,
        txtImage: 'Изображение',
        txtOf: 'из'
    });
});

$("#main-contact-form").submit(function (event) {
// cancels the form submission
    event.preventDefault();
    submitForm();
});

function submitForm() {
// Переменные с данными из формы
    var name = $("#name").val();
    var email = $("#email").val();
    var subject = $("#subject").val();
    var message = $("#message").val();
    $.ajax({
        type: "POST",
        url: "/site/message",
        data: "name=" + name + "&email=" + email + "&message=" + message,
        success: function (data) {
           if (data == "success") {
                formSuccess();
                //$("#main-contact-form")[0].reset();
           }
        }
    });
}
function formSuccess() {

    $("#msgSubmit").removeClass("hidden");
    //$("#contactForm")[0].reset();
}
/*---------------------Карта Google---------------------------- */
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

/*scroll to top*/

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
});




/*-----------------Ajax-функции для работы с корзиной----------------*/
$(document).ready(function () {
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
