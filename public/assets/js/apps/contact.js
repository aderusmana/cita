$(function () {
  function checkall(clickchk, relChkbox) {
    var checker = $("#" + clickchk);
    var multichk = $("." + relChkbox);

    checker.click(function () {
      multichk.prop("checked", $(this).prop("checked"));
      $(".show-btn").toggle();
    });
  }

  checkall("contact-check-all", "contact-chkbox");

  $("#input-search").on("keyup", function () {
    var rex = new RegExp($(this).val(), "i");
    $(".search-table .search-items:not(.header-item)").hide();
    $(".search-table .search-items:not(.header-item)")
      .filter(function () {
        return rex.test($(this).text());
      })
      .show();
  });

  $("#btn-add-contact").on("click", function (event) {
    $("#addContactModal #btn-add").show();
    $("#addContactModal #btn-edit").hide();
    $("#addContactModal").modal("show");
  });

  function addContact() {
    $("#btn-add").click(function () {
      var getParent = $(this).parents(".modal-content");

      var $_name = getParent.find("#name");
      var $_email = getParent.find("#email");
      var $_nik = getParent.find("#nik");
      var $_departmentId = getParent.find("#department_id");
      var $_positionId = getParent.find("#position_id");

      var $_getValidationField =
        document.getElementsByClassName("validation-text");
      var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
      var phoneReg = /^\d{6}$/; // Updated regex for 6 digits

      var $_nameValue = $_name.val();
      var $_emailValue = $_email.val();
      var $_nikValue = $_nik.val();
      var $_departmentIdValue = $_departmentId.val();
      var $_positionIdValue = $_positionId.val();

      if ($_nameValue == "") {
        if ($_getValidationField[0]) {
          $_getValidationField[0].innerHTML = "Name must be filled out";
          $_getValidationField[0].style.display = "block";
        }
      } else {
        if ($_getValidationField[0]) {
          $_getValidationField[0].style.display = "none";
        }
      }

      if ($_emailValue == "") {
        if ($_getValidationField[1]) {
          $_getValidationField[1].innerHTML = "Email Id must be filled out";
          $_getValidationField[1].style.display = "block";
        }
      } else if (reg.test($_emailValue) == false) {
        if ($_getValidationField[1]) {
          $_getValidationField[1].innerHTML = "Invalid Email";
          $_getValidationField[1].style.display = "block";
        }
      } else {
        if ($_getValidationField[1]) {
          $_getValidationField[1].style.display = "none";
        }
      }

      if ($_nikValue == "") {
        if ($_getValidationField[2]) {
          $_getValidationField[2].innerHTML = "Invalid (Enter 6 Digits)";
          $_getValidationField[2].style.display = "block";
        }
      } else if (phoneReg.test($_nikValue) == false) {
        if ($_getValidationField[2]) {
          $_getValidationField[2].innerHTML = "Please Enter A numeric value";
          $_getValidationField[2].style.display = "block";
        }
      } else {
        if ($_getValidationField[2]) {
          $_getValidationField[2].style.display = "none";
        }
      }

      if (
        $_nameValue == "" ||
        $_emailValue == "" ||
        reg.test($_emailValue) == false ||
        $_nikValue == "" ||
        phoneReg.test($_nikValue) == false
      ) {
        return false;
      }

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth()); //January is 0!
      var time = String(today.getTime());
      var yyyy = today.getFullYear();
      var monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];
      today = dd + " " + monthNames[mm] + " " + yyyy;
      var cdate = dd + mm + time;

      $html =
        '<tr class="search-items">' +
        "<td>" +
        '<div class="n-chk align-self-center text-center">' +
        '<div class="form-check">' +
        '<input type="checkbox" class="form-check-input contact-chkbox primary" id="' +
        cdate +
        '">' +
        '<label class="form-check-label" for="' +
        cdate +
        '"></label>' +
        "</div>" +
        "</div>" +
        "</td>" +
        "<td>" +
        '<div class="d-flex align-items-center">' +
        '<img src="../assets/images/profile/user-1.jpg" alt="avatar" class="rounded-circle" width="35">' +
        '<div class="ms-3">' +
        '<div class="user-meta-info">' +
        '<h6 class="user-name mb-0" data-name=' +
        $_nameValue +
        ">" +
        $_nameValue +
        "</h6>" +
        '<span class="user-nik fs-3" data-nik=' +
        $_nikValue +
        ">" +
        $_nikValue +
        "</span>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</td>" +
        "<td>" +
        '<span class="usr-email-addr" data-email=' +
        $_emailValue +
        ">" +
        $_emailValue +
        "</span>" +
        "</td>" +
        "<td>" +
        '<span class="usr-department" data-department-id=' +
        $_departmentIdValue +
        ">" +
        $_departmentIdValue +
        "</span>" +
        "</td>" +
        "<td>" +
        '<span class="usr-position" data-position-id=' +
        $_positionIdValue +
        ">" +
        $_positionIdValue +
        "</span>" +
        "</td>" +
        "<td>" +
        '<div class="action-btn">' +
        '<a href="javascript:void(0)" class="text-info edit"><i class="ti ti-eye fs-5"></i></a>' +
        '<a href="javascript:void(0)" class="text-dark delete ms-2"><i class="ti ti-trash fs-5"></i></a>' +
        "</div>" +
        "</td>" +
        "</tr>";

      $(".search-table > tbody >tr:first").before($html);
      $("#addContactModal").modal("hide");

      $_name.val("");
      $_email.val("");
      $_nik.val("");
      $_departmentId.val("");
      $_positionId.val("");

      deleteContact();
      editContact();
      checkall("contact-check-all", "contact-chkbox");
    });
  }

  $("#addContactModal").on("hidden.bs.modal", function (e) {
    var $_name = document.getElementById("name");
    var $_email = document.getElementById("email");
    var $_nik = document.getElementById("nik");
    var $_departmentId = document.getElementById("department_id");
    var $_positionId = document.getElementById("position_id");
    var $_getValidationField =
      document.getElementsByClassName("validation-text");

    $_name.value = "";
    $_email.value = "";
    $_nik.value = "";
    $_departmentId.value = "";
    $_positionId.value = "";

    for (var i = 0; i < $_getValidationField.length; i++) {
      e.preventDefault();
      $_getValidationField[i].style.display = "none";
    }
  });

  function editContact() {
    $(".edit").on("click", function (event) {
      $("#addContactModal #btn-add").hide();
      $("#addContactModal #btn-edit").show();

      // Get Parents
      var getParentItem = $(this).parents(".search-items");
      var getModal = $("#addContactModal");

      // Get List Item Fields
      var $_name = getParentItem.find(".user-name");
      var $_email = getParentItem.find(".usr-email-addr");
      var $_nik = getParentItem.find(".user-nik");
      var $_departmentId = getParentItem.find(".usr-department");
      var $_positionId = getParentItem.find(".usr-position");
      var $_roles = getParentItem.find(".usr-roles"); // Assuming you have a data attribute for roles

      // Get Attributes
      var $_nameAttrValue = $_name.attr("data-name");
      var $_emailAttrValue = $_email.attr("data-email");
      var $_nikAttrValue = $_nik.attr("data-nik");
      var $_departmentIdAttrValue = $_departmentId.attr("data-department-id");
      var $_positionIdAttrValue = $_positionId.attr("data-position-id");
      var $_rolesAttrValue = $_roles.attr("data-roles"); // Assuming roles are stored in a data attribute
      var $_idAttrValue = getParentItem.attr("data-id");

      // Get Modal Attributes
      var $_getModalNameInput = getModal.find("#name");
      var $_getModalEmailInput = getModal.find("#email");
      var $_getModalNikInput = getModal.find("#nik");
      var $_getModalDepartmentIdInput = getModal.find("#department_id");
      var $_getModalPositionIdInput = getModal.find("#position_id");
      var $_getModalRolesInput = getModal.find("#roles");

      // Set Modal Field's Value
      $_getModalNameInput.val($_nameAttrValue);
      $_getModalEmailInput.val($_emailAttrValue);
      $_getModalNikInput.val($_nikAttrValue);
      $_getModalDepartmentIdInput.val($_departmentIdAttrValue);
      $_getModalPositionIdInput.val($_positionIdAttrValue);
      $_getModalRolesInput.val($_rolesAttrValue); // Set the selected role

      $("#addContactModal").modal("show");

      $("#btn-edit").click(function () {
        var getParent = $(this).parents(".modal-content");

        var $_getInputName = getParent.find("#name");
        var $_getInputEmail = getParent.find("#email");
        var $_getInputNik = getParent.find("#nik");
        var $_getInputDepartmentId = getParent.find("#department_id");
        var $_getInputPositionId = getParent.find("#position_id");

        var $_nameValue = $_getInputName.val();
        var $_emailValue = $_getInputEmail.val();
        var $_nikValue = $_getInputNik.val();
        var $_departmentIdValue = $_getInputDepartmentId.val();
        var $_positionIdValue = $_getInputPositionId.val();

        // AJAX call to update user
        $.ajax({
          url: `/users/${$_idAttrValue}`,
          type: 'PUT',
          data: {
            name: $_nameValue,
            email: $_emailValue,
            nik: $_nikValue,
            department_id: $_departmentIdValue,
            position_id: $_positionIdValue,
            roles: $_getModalRolesInput.val()
          },
          success: function(response) {
            // Update UI with new values
            $_name.text($_nameValue);
            $_email.text($_emailValue);
            $_nik.text($_nikValue);
            $_departmentId.text($_departmentIdValue);
            $_positionId.text($_positionIdValue);
            $("#addContactModal").modal("hide");
          }
        });
      });
    });
  }

  $(".delete-multiple").on("click", function () {
    var inboxCheckboxParents = $(".contact-chkbox:checked").parents(
      ".search-items"
    );
    inboxCheckboxParents.remove();
  });

  function deleteContact() {
    $(".delete").on("click", function (event) {
      event.preventDefault();
      var getParentItem = $(this).parents(".search-items");
      var id = getParentItem.attr("data-id"); // Assuming each row has a data-id attribute

      // AJAX call to delete user
      $.ajax({
        url: `/users/${id}`,
        type: 'DELETE',
        success: function(response) {
          getParentItem.remove();
        }
      });
    });
  }

  deleteContact();
  addContact();
  editContact();
});


// Validation Process

var $_getValidationField = document.getElementsByClassName("validation-text");
var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
var phoneReg = /^\d{6}$/; // Updated regex for 6 digits

getNameInput = document.getElementById("name");

getNameInput.addEventListener("input", function () {
  getNameInputValue = this.value;

  if (getNameInputValue == "") {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[0].innerHTML = "Name Required";
      $_getValidationField[0].style.display = "block";
    } else {
      console.error("Validation field not found");
    }
  } else {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[0].style.display = "none";
    } else {
      console.error("Validation field not found");
    }
  }
});

getEmailInput = document.getElementById("email");

getEmailInput.addEventListener("input", function () {
  getEmailInputValue = this.value;

  if (getEmailInputValue == "") {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[1].innerHTML = "Email Required";
      $_getValidationField[1].style.display = "block";
    } else {
      console.error("Validation field not found");
    }
  } else if (reg.test(getEmailInputValue) == false) {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[1].innerHTML = "Invalid Email";
      $_getValidationField[1].style.display = "block";
    } else {
      console.error("Validation field not found");
    }
  } else {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[1].style.display = "none";
    } else {
      console.error("Validation field not found");
    }
  }
});

getNikInput = document.getElementById("nik");

getNikInput.addEventListener("input", function () {
  getNikInputValue = this.value;

  if (getNikInputValue == "") {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[2].innerHTML = "NIK Number Required";
      $_getValidationField[2].style.display = "block";
    } else {
      console.error("Validation field not found");
    }
  } else if (phoneReg.test(getNikInputValue) == false) {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[2].innerHTML = "Invalid (Enter 6 Digits)";
      $_getValidationField[2].style.display = "block";
    } else {
      console.error("Validation field not found");
    }
  } else {
    if ($_getValidationField.length > 0) { // Check if the element exists
      $_getValidationField[2].style.display = "none";
    } else {
      console.error("Validation field not found");
    }
  }
});