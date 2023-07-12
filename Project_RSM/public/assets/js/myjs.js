
/*==================================================================
Show moal*/
$('.js-show-modal').on('click', function (e) {
    e.preventDefault();
    $('.js-modal').addClass('show-modal');
    $(this).addClass('show-del');
});

$('.js-hide-modal').on('click', function () {
    $('.js-modal').removeClass('show-modal');
    // $('.js-modal').removeClass('show-modal');
});

$('.js-show-modal2').on('click', function (e) {
    e.preventDefault();
    $('.js-modal2').addClass('show-modal');
    $(this).addClass('show-del2');
});

$('.js-hide-modal2').on('click', function () {
    $('.js-modal2').removeClass('show-modal');
});

$('.js-show-modal3').on('click', function (e) {
    e.preventDefault();
    $('.js-modal3').addClass('show-modal');
    $(this).addClass('show-del3');
});

$('.js-hide-modal3').on('click', function () {
    $('.js-modal3').removeClass('show-modal');
});


//Show success
function showSuccessNotification(background, content) {
    const notification = $('<div class="success-notification d-flex"></div>').css('background-color', background);
    const icon = $('<div class="icon-notification me-2"><i class="bi bi-check-circle-fill"></i></div>');
    const text = $('<div class="text-notification"></div>').text(content);
    notification.append(icon).append(text);
    $('body').append(notification);
    setTimeout(() => {
        notification.addClass('show');
    }, 100);
    setTimeout(() => {
        notification.removeClass('show');
    }, 4000);
    setTimeout(() => {
        notification.remove();
    }, 4200);
}

// Fo
// const itemsCart = [];
$(document).ready(function () {
    var today = moment();
    var maxDate = moment().add(30, 'days');

    $("#BookingDate").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: today.toDate(),
        maxDate: maxDate.toDate(),
        defaultDate: +0,
        monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
            'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ],
        monthNamesShort: ['Thg 1', 'Thg 2', 'Thg 3', 'Thg 4', 'Thg 5', 'Thg 6', 'Thg 7', 'Thg 8',
            'Thg 9', 'Thg 10', 'Thg 11', 'Thg 12'
        ],
        dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
        dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });
});

$(document).ready(function () {
    $('#TimeSlot').timepicker({
        timeFormat: 'HH:mm',
        interval: 30, // Các khoảng thời gian giữa các mốc
        minTime: '06:30', // Giờ bắt đầu
        maxTime: '21:00', // Giờ kết thúc
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});

function onInput(event) {
    const inputElement = $(event.target);
    if (inputElement.val().trim() === "") {
        inputElement.addClass("is-invalid");
    } else {
        var invalidFeedback = inputElement.parent().find('.invalid-feedback');
        inputElement.removeClass("is-invalid");
        var checkValue = inputElement.parent().find('.check-value');
        inputElement.removeClass("is-invalid");
        checkValue.hide();
        invalidFeedback.hide();
    }
}

$('#PhoneNumber').on('keyup', function () {
    var input = $(this).val();
    // Xóa các kí tự không phải số từ đầu vào
    input = input.replace(/\D/g, '');
    // Giới hạn đầu vào chỉ tối đa 10 kí tự
    input = input.substring(0, 10);
    // Cập nhật giá trị mới vào ô input
    $(this).val(input);
});

function checkSelectInput(event) {
    const select = $(event.target);
    if (select.value == "0") {
        var invalidFeedback = select.parent().find('.invalid-feedback');
        select.addClass("is-invalid");
        invalidFeedback.show();
    } else {
        var invalidFeedback = select.parent().find('.invalid-feedback');
        select.removeClass("is-invalid");
        invalidFeedback.hide();
    }
}

// Lặp qua tất cả các thẻ select và gán sự kiện onchange cho chúng
const selects = document.querySelectorAll("select");
for (let i = 0; i < selects.length; i++) {
    selects[i].addEventListener("change", checkSelectInput);
}

function CheckValueBooking() {
    const NumberGuests = $("#NumberGuests");
    const FullName = $("#FullName");
    const PhoneNumber = $("#PhoneNumber");
    const TimeSlot = $("#TimeSlot");
    const BookingDate = $("#BookingDate");
    const IdBranch = $("#IdBranch");

    var isValid = true; // Biến flag mặc định là true

    if (parseInt(IdBranch.val()) === 0) {
        var invalidFeedback = IdBranch.parent().find('.invalid-feedback');
        invalidFeedback.show();
        IdBranch.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    if (BookingDate.val() === "") {
        var invalidFeedback = BookingDate.parent().find('.invalid-feedback');
        invalidFeedback.show();
        BookingDate.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    if (TimeSlot.val().trim() === "") {
        var invalidFeedback = TimeSlot.parent().find('.invalid-feedback');
        invalidFeedback.show();
        TimeSlot.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    if (NumberGuests.val().trim() === "") {
        var invalidFeedback = NumberGuests.parent().find('.invalid-feedback');
        invalidFeedback.show();
        NumberGuests.addClass("is-invalid");
        isValid = false;
    }

    if (parseInt(NumberGuests.val().trim()) < 1 || parseInt(NumberGuests.val().trim()) > 50) {
        var invalidFeedback = NumberGuests.parent().find('.check-value');
        invalidFeedback.show();
        NumberGuests.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    if (FullName.val().trim() === "") {
        var invalidFeedback = FullName.parent().find('.invalid-feedback');
        invalidFeedback.show();
        FullName.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    if (PhoneNumber.val().trim() === "") {
        var invalidFeedback = PhoneNumber.parent().find('.invalid-feedback');
        invalidFeedback.show();
        PhoneNumber.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    // console.log(TimeSlot.val());
    return isValid; // Trả về biến flag
}


const btnAddCart = $('.btn-add-cart')
if (btnAddCart.length) {
    const formitemsCart = $('#form-items-selected');

    btnAddCart.each(function () {
        $(this).on('click', function () {

            const idItems = $(this).data('id');
            const Price = $(this).data('price');
            const ItemsName = $(this).data('name');
            const PriceCost = $(this).data('pricecost');

            var check = $.inArray(idItems, $.map(itemsCart, function (item) {
                return item.IdItems;
            }));

            //Nếu đã có thì chỉ tăng số lượng
            if (check !== -1) {
                const Items = itemsCart.find(item => item.IdItems === idItems);
                Items.Quantity++;
                //Update số lượng và thành tiền
                updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)
                //Tính lại tổng cộng
                $('.js-panel-cart').addClass('show-header-cart');

                $.ajax({
                    url: '/add-cart/' + idItems,
                    method: 'GET',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('.js-panel-cart').addClass('show-header-cart');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    }
                });

                return;
            }

            let items = $('<div>', {
                'class': `accordion-item items-selected wrap-cart-${idItems}`,
                html: `\n
                        <div class="accordion-header pt-3 pb-2">\n
                            <div class="d-flex collapsed justify-content-between align-items-center">\n
                                <div class="col-xl-5 d-flex flex-column m-0 p-0">\n
                                    <p class="m-0 fw-bold">\n
                                        ${ItemsName}\n
                                    </p>\n
                                    <p class="m-0">\n
                                        ${Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫\n
                                    </p>\n
                                </div>\n
                                <div class="col-xl-3 m-0 fw-bold d-flex justify-content-center align-items-center">\n
                                    <a onclick="subQuantity(this)" data-id="${idItems}" class="fs-5 py-0 px-1 pe-1 btn btn-light">\n
                                        <i class="text-danger bi bi-dash"></i>\n
                                    </a>\n
                                    <p class="m-0 fs-6 text-center px-2 quantity quantity-${idItems}">\n
                                        1\n
                                    </p>\n
                                    <a onclick="addQuantity(this)" data-id="${idItems}" class="fs-5 py-0 px-1 ps-1 btn btn-light">\n
                                        <i class="text-success bi bi-plus"></i>\n
                                    </a>\n
                                </div>\n
                                <p class="col-xl-3 m-0 fw-bold text-end total-of-item-${idItems}">\n
                                    ${Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫\n
                                </p>\n
                                <div class="col-xl-1 fs-3 py-0 text-end ps-2" onclick="deleteItemCartView(this)" data-id="${idItems}">\n
                                    <i class="text-danger fs-5 bi bi-trash3"></i>\n
                                </div>\n
                            </div>\n
                        </div>`
            });
            formitemsCart.append(items);

            //push vào list selected
            itemsCart.push({
                IdItems: idItems,
                Quantity: 1,
                Price: Price,
                PriceCost: PriceCost
            });

            $.ajax({
                url: '/add-cart/' + idItems,
                method: 'GET',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.js-panel-cart').addClass('show-header-cart');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                }
            });
            console.log(itemsCart);
        });
    });
}

function updateQuanTotal(IdItems, Quantity, Price) {
    $(`.quantity-${IdItems}`).each(function () {
        $(this).text(Quantity);
    });

    let totalOfItem = parseInt(Price) * parseInt(Quantity);

    $(`.total-of-item-${IdItems}`).each(function () {
        $(this).text(totalOfItem.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }));
    });
}

function addQuantity(item) {
    const id = $(item).data('id');
    const Items = itemsCart.find(item => item.IdItems == id);
    Items.Quantity++;

    //Update số lượng và thành tiền
    updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)

    //Tính lại tổng cộng
    totalMoney();

    //Update session
    $.ajax({
        url: '/add-cart/' + id,
        method: 'GET',
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) { },
        error: function (jqXHR, textStatus, errorThrown) {
            showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
        }
    });
}

function subQuantity(item) {
    const id = $(item).data('id');

    const Items = itemsCart.find(item => item.IdItems == id);

    if (Items.Quantity <= 1) {
        return;
    }
    Items.Quantity--

    //Update số lượng và thành tiền
    updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)
    //Tính lại tổng cộng
    totalMoney();

    $.ajax({
        url: '/sub-cart/' + id,
        method: 'GET',
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) { },
        error: function (jqXHR, textStatus, errorThrown) {
            showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
        }
    });
}

totalMoney();

function totalMoney() {
    var total = 0;

    const listItemCart = $('.items-cart');
    if (listItemCart.length) {
        listItemCart.each(function () {
            let price = $(this).find('input[name="Price"]').val();
            let quantity = $(this).find('.quantity').text();
            let itemTotal = price * quantity;
            total += itemTotal;
        });
    }

    let totalMoney = $('#total-money');
    if (totalMoney.length) {
        totalMoney.text(total.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }));

        $('input[name="Total"]').val(total);

        $('#total-amount').text(total.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }));
    }
}

//Xóa 1 mặt hàng
function deleteItemCartView(item) {
    const id = $(item).data('id');
    $.ajax({
        url: '/delete-cart/' + id,
        method: 'GET',
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            var check = $.inArray(id, $.map(itemsCart, function (item) {
                return item.IdItems;
            }));

            if (check !== -1) {
                //Xóa ptu khỏi itemsCart
                itemsCart.splice(check, 1);
                $(`.wrap-cart-${id}`).each(function () {
                    $(this).remove();
                });

                //Tính lại tổng cộng
                totalMoney();
            }

            if (itemsCart.length === 0) {
                window.location.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Đã có lỗi xảy ra');
        }
    });
}

//Xóa toàn bộ giỏ hàng
const deleteAllCart = $('#btn-del-all-cart');
if (deleteAllCart.length) {
    deleteAllCart.click(function () {
        const listItemCart = $('.items-cart');
        if (listItemCart.length) {
            listItemCart.each(function () {

                const id = $(this).data('id');

                $.ajax({
                    url: '/delete-cart/' + id,
                    method: 'GET',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        var check = $.inArray(id, $.map(itemsCart, function (item) {
                            return item.IdItems;
                        }));

                        if (check !== -1) {
                            //Xóa ptu khỏi itemsCart
                            itemsCart.splice(check, 1);
                            $(`.wrap-cart-${id}`).each(function () {
                                $(this).remove();
                            });

                            //Tính lại tổng cộng
                            totalMoney();
                        }

                        if (itemsCart.length === 0) {
                            window.location.reload();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showSuccessNotification('rgba(255, 0, 0, 0.7)',
                            'Đã có lỗi xảy ra');
                    }
                });
            });
        }
    })
}
