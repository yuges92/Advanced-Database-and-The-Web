$(function() {
    $('#rating').prop('disabled', true);
    $('#newDeliveryAddress').hide();
    $('#checkOutForm').hide();

    //
    showCheckOutBtn();
    getWineTypes();
    hideLogoutLoginBtn();
    checkUsername();
    checkPasswordMatch();
    checkEmail();
    //sayHello();
    //checkout page
    //$('#deliveryAddress').hide();
    hideShowDeliveryAddress();
    inputValidation();
    submitForm();
    addAdmin();
    login();
    changePassword();
    addNewStock();
    hideCheckout();
    checkShoppingBasket();
    slideToggleBtn();
    //hideEditBtns();
    //newDeliveryAddressRequired();
    addPromotionTypeForm();
    getPromoType();
});

// function showNewDeliveryAddress() {
//   $('#newDeliveryAddress').show();
//   $('#newAddressRadio').attr('checked', true);
//
// }
//

function hideShowDeliveryAddress() {
    $('#newAddressRadio').click(function(event) {
        $('#newDeliveryAddress').show('slow');
        $('#deliveryfirstLineAddress').prop("required", true);
        $('#deliveryTown').prop("required", true);
        $('#deliveryPostcode').prop("required", true);
        $('#deliveryRegion').prop("required", true);
    });
    $('#currentAddressRadio').click(function(event) {
        $('#deliveryfirstLineAddress').removeAttr("required");
        $('#deliveryTown').removeAttr("required");
        $('#deliveryPostcode').removeAttr("required");
        $('#deliveryRegion').removeAttr("required");
        $('#newDeliveryAddress').hide('slow');
    });
}

function showCheckOutBtn() {
    var total = $('#totalCost').val();
    if (total > 0) {
        $('#totalCostLBL').show();
        $('#totalCost').show();
    } else {
        $('#totalCostLBL').hide();
        $('#totalCost').hide();
    }
}



function hideLogoutLoginBtn() {
    var logoutBtn = $('#logoutBtn');
    var loginBtn = $('#loginBtn');
    var registerBtn = $('#registerBtn');
    $.ajax({
        url: '../Controller/login.php',
        type: 'POST',
        data: {
            checkLogin: 'checkLogin'
        },
        success: function(response) {
            if (response == "true") {
                loginBtn.hide();
                registerBtn.hide();
                logoutBtn.show();
            } else {
                logoutBtn.hide();
                loginBtn.show();
                registerBtn.show();

            }
        }
    });
}

function hideEditBtns() {
    var editBtn = $('a[name="editWineBtn"]');
    var editBtn = $('a[name="editWineBtn"]');
    var editBtn = $('a[name="editWineBtn"]');
    editBtn.hide();
    $.ajax({
        url: '../Controller/login.php',
        type: 'POST',
        data: {
            checkLogin: 'checkUser'
        },
        success: function(response) {
            if (response == "admin") {
                editBtn.show();

            } else {
                editBtn.hide();
            }
        }
    });
}





function getWineTypes() {
    $("#wineTypeID").change(function() {
        var wineTypeID = $(this).children(":selected").text();
        $.ajax({
            url: '../Controller/addWine.php',
            type: 'POST',
            data: {
                wineTypeID: wineTypeID
            },
            success: function(response) {
                var wineType = JSON.parse(response);
                $('#country').val(wineType.country);
                $('#colour').val(wineType.colour);
                $('#newArrival').val(wineType.newArrival);

                if ($('#wineTypeID').val() == '') {
                    $('#rating').prop('disabled', true);
                } else {
                    $('#rating').prop('disabled', false);
                }
                if ($('#colour').val() == 'White') {
                    $("#rating option[value='Dry']").prop('disabled', false);
                    $("#rating option[value='Sweet']").prop('disabled', false);
                    $("#rating option[value='Light']").prop('disabled', true);
                    $("#rating option[value='Full-Bodied']").prop('disabled', true);
                } else if ($('#colour').val() == 'Red') {
                    $("#rating option[value='Dry']").prop('disabled', true);
                    $("#rating option[value='Sweet']").prop('disabled', true);
                    $("#rating option[value='Light']").prop('disabled', false);
                    $("#rating option[value='Full-Bodied']").prop('disabled', false);
                } else {
                    $("#rating option[value='Dry']").prop('disabled', false);
                    $("#rating option[value='Sweet']").prop('disabled', false);
                    $("#rating option[value='Light']").prop('disabled', false);
                    $("#rating option[value='Full-Bodied']").prop('disabled', false);
                }

            }
        });
    });
}

function addToShoppingBasket(wineID) {
    var quantity = $("input[name=" + "quantity" + wineID + "]").val();
    var caseOrBottle = $("select[name=" + "caseOrBottle" + wineID + "]").find(":selected").text();
    var wineID = wineID;
    var available = $("input[name=" + "availability" + wineID + "]").val();
    var noOfBottleInACase = $("input[name=" + "noOfBottleInACase" + wineID + "]").val();
    var addToShoppingBasket = 'addToShoppingBasket';

    if (caseOrBottle == 'Case') {
        var quantityToCheck = quantity * noOfBottleInACase;
    } else {
        quantityToCheck = quantity;
    }

    if (quantityToCheck > available) {
        alert('Not enough stock available');
    } else {
        if (quantity < 1) {
            alert('quantity needed');
        } else {
            $.ajax({
                type: 'POST',
                url: '../Controller/shoppingBasket.php',
                data: {
                    wineID: wineID,
                    quantity: quantity,
                    caseOrBottle: caseOrBottle,
                    addToShoppingBasket: addToShoppingBasket
                },
                success: function(response) {
                    if (response == 'true') {
                        alert('Added to Basket');
                    } else {
                        alert('The wine Already Exist in the shopping Basket!!');
                    }

                }
            });
        }
    }



}

function deleteFromSB(wineID) {
    //var wineID2=wineID.match(/\d+/);//

    var caseOrBottle = $("#caseOrBottle" + wineID).text();
    var deleteFromSB = 'deleteFromSB';
    var confirmation = confirm('Do you really want to delete?');
    var div = $("#divCaseOrBottle" + wineID);

    if (confirmation == true) {
        $.ajax({
            type: 'POST',
            url: '../Controller/delete.php',
            data: {
                wineID: wineID,
                caseOrBottle: caseOrBottle,
                deleteFromSB: deleteFromSB
            },
            success: function(response) {
                if (response == 'true') {
                    alert('Wine removed from your shopping basket');
                    div.hide('slow');
                    checkShoppingBasket();
                }
            }
        });
    }
}

function sayHello() {
    alert('hello');
}

//for register page
function checkUsername() {
    var usernameInput = $('#username');
    usernameInput.blur(function(event) {

        var username = $('#username').val();
        if (username.length < 5) {
            usernameInput.addClass('error').removeClass('success');
            $('#usernameFeed').text('').removeClass('errorForText');
        } else {
            usernameInput.removeClass('success');
            $.ajax({
                type: 'POST',
                url: '../Controller/register.php',
                data: {
                    usernameCheck: 'usernameCheck',
                    username: username
                },
                success: function(resposnse) {
                    if (resposnse == 'true') {
                        usernameInput.addClass('success').removeClass('error');
                        $('#usernameFeed').text('').removeClass('errorForText');
                    } else {
                        usernameInput.addClass('error').removeClass('success');
                        $('#usernameFeed').text(' Not Available').addClass('errorForText');
                    }
                }
            });
        }
    });
}

function checkEmail() {
    var emailInput = $('#email');
    emailInput.blur(function(event) {
        if (emailInput.val().length > 3) {
            emailCheck = emailInput.val();
            $.ajax({
                type: 'POST',
                url: '../Controller/register.php',
                data: {
                    emailCheck: emailCheck
                },
                success: function(response) {
                    if (response == 'true') {

                        emailInput.addClass('success').removeClass('error');
                        $('#emailFeed').text('').removeClass('errorForText');
                    } else {
                        emailInput.addClass('error').removeClass('success');
                        $('#emailFeed').text(' Email Exist').addClass('errorForText');

                    }
                }
            });
        } else {
            $('#emailFeed').text('').removeClass('errorForText');
        }

    });
}

function checkPasswordMatch() {
    $('#confirmPassword').blur(function(event) {
        var cPass = $('#confirmPassword');
        var pass = $('#password');
        if (cPass.length > 6) {
            if (cPass.val() == pass.val()) {
                cPass.addClass('success').removeClass('error');
                pass.addClass('success').removeClass('error');
                return true;
            } else {
                cPass.addClass('error').removeClass('success');
                pass.removeClass('success');
                return false;
            }
        }
    });
}

function validateField(id, length) {
    id.blur(function(event) {
        var value = $.trim(id.val());
        if (value.length > length) {
            id.removeClass('error').addClass('success');
            return true;
        } else {
            id.addClass('error').removeClass('success');
            return false;
        }
    });
}

function inputValidation() {
    var fnameCheck = validateField($('#firstname'), 1);
    var lnameCheck = validateField($('#lastname'), 1);
    var firstLineAddressCheck = validateField($('#firstLineAddress'), 5);
    var townCheck = validateField($('#town'), 4);
    var postcodeCheck = validateField($('#postcode'), 5);
    var regionCheck = validateField($('#region'), 3);
}


function submitForm() {
    $('#registerForm').submit(function(event) {
        event.preventDefault();
        var cPass = $('#confirmPassword');
        var pass = $('#password');
        if (cPass.val() == pass.val()) {
            formData = $(this).serialize();
            $.ajax({
                url: '../Controller/register.php',
                type: 'POST',
                data: {
                    register: formData
                },
                success: function(response) {
                    if (response == 'true') {
                      alert('Successfuly registered. Please use your username and password to login');
                        location.href = "../View/login.php";
                    } else {
                        alert('Please Enter Valid Details');
                    }
                }
            });
        } else {
            alert('The Password do not Match');
        }
    });
}

function addAdmin() {
    $('#addAdminForm').submit(function(event) {
        event.preventDefault();
        var addAdminForm = $(this).serialize();

        $.ajax({
            url: '../Controller/manageAdmin.php',
            type: 'POST',
            data: {
                addAdminForm: addAdminForm
            },
            success: function(response) {
                if (response == 'admin added') {
                    alert(response);
                } else {
                    alert('Not Added');
                }
            }
        });
    });
}


function login() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        var username = $('#loginUsername').val();
        var password = $('#loginPassword').val();
        $.ajax({
            url: '../Controller/login.php',
            type: 'POST',
            data: {
                login,
                username: username,
                password: password
            },
            success: function(response) {
                if (response == 'Customer') {
                    location.href = '../index.php';
                } else if (response == 'Admin') {
                    location.href = '../View/manage.php';
                } else {
                    $('#loginError').text(' Please Check Your Login Details').addClass('errorForText');

                }
            }
        });
    });
}


function changePassword() {
    $('#changePassword').submit(function(event) {
        event.preventDefault();
        var changePassword = $(this).serialize();

        $.ajax({
            url: '../Controller/login.php',
            type: 'POST',
            data: {
                changePassword: changePassword
            },
            success: function(response) {
                alert(response);
            }
        });
    });
}

function deleteWine(wineID) {
    var confirmation = confirm('Do you really want to delete?');
    if (confirmation) {
        $.ajax({
            url: '../Controller/manage.php',
            type: 'POST',
            data: {
                deleteWineID: wineID
            },
            success: function(response) {
                if (response == 'Wine Deleted') {
                    $('#feedbackForWine').text('Wine Deleted').show('slow');
                    $('#wineRow' + wineID).hide('slow');
                } else {
                    $('#feedbackForWine').text('Unsuccessfull').show('slow');
                }
            }

        });
    }

}


function deleteWineType(wineTypeID) {
    var confirmation = confirm('Do you really want to delete?');
    if (confirmation) {
        $.ajax({
            url: '../Controller/manage.php',
            type: 'POST',
            data: {
                deleteWineTypeID: wineTypeID
            },
            success: function(response) {
                if (response == 'WineType Deleted') {
                    $('#feedbackForWineType').text('WineType Deleted').show("slow");
                    $('#wineTypeRow' + wineTypeID).hide('slow');
                } else {
                    $('#feedbackForWineType').text('Unsuccessfull').show("slow");
                }
            }

        });
    }
}


function addNewStock() {
    $('#addNewWineStockForm').submit(function(event) {
        event.preventDefault();
        var addNewWineStockForm = $(this).serialize();
        $.ajax({
            url: '../Controller/manage.php',
            type: 'POST',
            data: {
                addNewWineStockForm: addNewWineStockForm
            },
            success: function(response) {
                alert(response);
                location.href = "../View/manage.php";

            }
        });
    });
}


function updateWineStock(id) {
    var centreID = $('#stockCentreID' + id).text();
    var wineID = $('#stockWineID' + id).text();
    var quantity = $('#stockQuantityID' + id).text();

    $.ajax({
        url: '../Controller/manage.php',
        type: 'POST',
        data: {
            updateStock: 'updateStock',
            centreID: centreID,
            wineID: wineID,
            quantity: quantity
        },
        success: function(response) {

            alert(response);
        }
    });
}


function hideCheckout() {
    $.ajax({
        url: '../Controller/checkout.php',
        type: 'POST',
        data: {
            checkBasket: 'checkBasket'
        },
        success: function(response) {
            if (response == 'basket empty') {
                $('#checkoutFeedback').text('Your basket is empty').addClass('empty');
            } else {
                $('#checkOutForm').show();
            }
        }
    });
}

function showAddNewStockForm() {
    $(this).click(function(event) {
        $('#addNewWineStock').show('slow');
    });
}


function checkShoppingBasket() {
    $.ajax({
        url: '../Controller/shoppingBasket.php',
        type: 'POST',
        data: {
            checkBasketEmpty: 'checkBasketEmpty'
        },
        success: function(response) {
            if (response == 'Your Shopping Basket is empty') {
                $('#shoppingBasketFeedback').text('Your basket is empty').addClass('empty');
                $('#totalCostLBLDiv').hide();
            }
        }
    });
}

function slideToggleBtn() {
    $('.toggleBtn ').click(function(event) {
        event.preventDefault();
        $(this).siblings('ul').slideToggle(1000);
        //  $(this).parent('ul').toggle(1000);
    });
}

function addToWishList(id) {
    var wineID = id;
    $.ajax({
        url: '../Controller/wishList.php',
        type: 'POST',
        data: {
            addToWishList: wineID
        },
        success: function(response) {
            if (response == 'added') {
                alert('Added to wish List');
            } else {
                alert('Failed to add or The wine already exist in the List');
            }
        }
    });
}

function removeFromWishList(id) {
    var wineID = id;
    $.ajax({
        url: '../Controller/wishList.php',
        type: 'POST',
        data: {
            removeWineFromList: wineID
        },
        success: function(response) {
            if (response == 'removed') {
                alert('Removed');
                 $('#wineName'+wineID).hide(500);
            } else {
                alert('Failed to remove ');
            }
        }
    });
}

function addPromotionTypeForm() {
  $('#addPromotionTypeForm').submit(function(event) {
    event.preventDefault();
    var form=$(this).serialize();
    $.ajax({
      url: '../Controller/managePromotions.php',
      type: 'POST',
      data: {addNewPromo:form},
      success: function(response){
        if(response=='added'){
          alert('Successfuly Added');
          location.href = "../View/managePromotions.php";
        }else {
          alert('Failed to add. The reason could be the promotion already exist.');
        }
      }

    });
  });
}

function getPromoType() {
  $('#promotionID').change(function(event) {
    var promotionID = $(this).children(":selected").text();
    $.ajax({
      url: '../Controller/managePromotions.php',
      type: 'POST',
      data: {getPromoType:promotionID},
      success: function(response){
        if(response=='failed'){

        }else {
          $('#promoType').val(response);
        }
      }

    });
  });
}
