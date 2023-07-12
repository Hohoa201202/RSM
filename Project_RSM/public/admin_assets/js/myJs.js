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


//load then top
window.addEventListener('load', function () {
    backToTop();
});


//back to top
function backToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

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

$('#PhoneNumber').on('keyup', function () {
    var input = $(this).val();
    // Xóa các kí tự không phải số từ đầu vào
    input = input.replace(/\D/g, '');
    // Giới hạn đầu vào chỉ tối đa 10 kí tự
    input = input.substring(0, 10);
    // Cập nhật giá trị mới vào ô input
    $(this).val(input);
});

//=============== Items - Mặt hàng ====================
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

function onInput(event) {
    const inputElement = $(event.target);
    if (inputElement.val().trim() == "") {
        inputElement.addClass("is-invalid");
    } else {
        var invalidFeedback = inputElement.parent().find('.invalid-feedback');
        inputElement.removeClass("is-invalid");
        invalidFeedback.hide();
    }
}

//Check toàn bộ mặt hàng
function toggleCheckboxes() {
    let checkboxes = document.querySelectorAll("#records_table input[type=checkbox]");
    let selectAllCheckbox = document.querySelector("#select-all-checkbox");
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = selectAllCheckbox.checked;
    }
    this.checked = false
}

//============== Role - Phân quyền ==============
function CheckValueRole() {
    const inputRoleName = $("#RoleName");
    var isValid = true; // Biến flag mặc định là true
    var checkboxes = myForm.querySelectorAll('input[type="checkbox"]'); // Lấy danh sách các checkbox

    // Kiểm tra xem có ít nhất một checkbox được chọn hay không
    var checked = false;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checked = true;
            break;
        }
    }

    // Nếu không có checkbox nào được chọn, ngăn form được gửi đi
    if (!checked) {
        var invalidFeedbackRole = document.querySelector('.invalid-feedback-role');
        invalidFeedbackRole.style.display = 'block';
        isValid = false;
    }

    // Kiểm tra giá trị của input RoleName
    if (inputRoleName.val().trim() === "") {
        var invalidFeedback = inputRoleName.parent().find('.invalid-feedback');
        invalidFeedback.show();
        inputRoleName.addClass("is-invalid");
        isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
    }

    return isValid; // Trả về biến flag
}

$(document).ready(function () {
    var today = moment();
    var maxDate = moment().add(30, 'days');

    const BookingDate = $("#BookingDate")
    if (BookingDate.length) {
        BookingDate.datepicker({
            dateFormat: "dd-mm-yy",
            minDate: today.toDate(),
            maxDate: maxDate.toDate(),
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
    }

    $(document).ready(function () {
        $('#TimeSlot').timepicker({
            timeFormat: 'HH:mm',
            interval: 30, // Các khoảng thời gian giữa các mốc
            minTime: '06:30', // Giờ bắt đầu
            maxTime: '19:00', // Giờ kết thúc
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });

    const btndelall = $('#delete-button')
    if (btndelall.length) {
        btndelall.click(function () {
            const table = $('.table-borderless.datatable');
            const checkboxes = table.find('input[type="checkbox"]');
            let isAnyChecked = false;

            checkboxes.each(function () {
                if ($(this).prop('checked')) {
                    isAnyChecked = true;
                    return false; // Thoát khỏi vòng lặp khi tìm thấy checkbox được chọn
                }
            });

            if (!isAnyChecked) {
                $('#alert-danger').removeClass('d-none');
                return false; // Ngăn không cho submit form
            }
        });
    }
});

