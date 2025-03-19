import $ from "jquery";
window.$ = window.jQuery = $;

$(document).ready(function () {
    // Open Modal for Create
    $("#addEmployeeBtn").click(function () {
        $("#employee_id").val(""); // Reset hidden input
        $("#employee_name").val(""); // Clear input field
        $("#employee_email").val("");
        $("#department_id").val(""); // Reset department selection
        $("#employeeModalLabel").text("Create Employee"); // Change modal title
        $("#employeeError").addClass("d-none").html(""); // Hide error message
        $("#employeeModal").modal("show"); // Show modal
    });

    // Open Modal for Edit (Event Delegation)
    $(document).on("click", ".edit-btn", function () {
        let employeeId = $(this).data("id");
        let employeeName = $(this).data("name");
        let employeeEmail = $(this).data("email");
        let departmentId = $(this).data("department-id");

        $("#employee_id").val(employeeId);
        $("#employee_name").val(employeeName);
        $("#employee_email").val(employeeEmail);
        $("#department_id").val(departmentId);

        $("#employeeModalLabel").text("Edit Employee"); // Change modal title
        $("#employeeError").addClass("d-none").html(""); // Hide error message
        $("#employeeModal").modal("show"); // Show modal
    });

    // CREATE / UPDATE - Submit Form
    $("#employeeForm").submit(function (event) {
        event.preventDefault();

        let employeeId = $("#employee_id").val();
        let employeeName = $("#employee_name").val();
        let employeeEmail = $("#employee_email").val();
        let departmentId = $("#department_id").val();
        let csrfToken = $('input[name="_token"]').val();

        let url = employeeId ? `/employees/update/${employeeId}` : "/employees/store";
        let method = employeeId ? "PUT" : "POST";

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: csrfToken,
                employee_name: employeeName,
                employee_email: employeeEmail,
                department_id: departmentId
            },
            success: function (response) {
                if (response.success) {
                    $("#employeeError").addClass("d-none").html(""); // Hide error message

                    if (employeeId) {
                        // Update existing row
                        $(`#row-${employeeId} .emp-name`).text(employeeName);
                        $(`#row-${employeeId} .emp-email`).text(employeeEmail);
                        $(`#row-${employeeId} .emp-dept`).text(response.department_name);
                        $(`#row-${employeeId} .edit-btn`).data("name", employeeName);
                        $(`#row-${employeeId} .edit-btn`).data("email", employeeEmail);
                        $(`#row-${employeeId} .edit-btn`).data("department-id", departmentId);
                    } else {
                        // Append new row for newly created employee
                        $("#employeeTableBody").append(`
                            <tr id="row-${response.employee.id}">
                                <td>${response.employee.id}</td>
                                <td class="emp-name">${response.employee.name}</td>
                                <td class="emp-email">${response.employee.email}</td>
                                <td class="emp-dept">${response.department_name}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" 
                                        data-id="${response.employee.id}" 
                                        data-name="${response.employee.name}" 
                                        data-email="${response.employee.email}" 
                                        data-department-id="${response.employee.department_id}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${response.employee.id}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        `);
                    }
                    $("#employeeModal").modal("hide"); // Hide modal
                } else {
                    $("#employeeError").removeClass("d-none").html(response.error); // Show error
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorMessages = "";

                if (Object.keys(errors).length) {
                    $.each(errors, function (key, messages) {
                        errorMessages += `<p>${messages[0]}</p>`; // Show first error message
                    });
                } else {
                    errorMessages = "An error occurred. Please try again.";
                }

                $("#employeeError").removeClass("d-none").html(errorMessages);
            }
        });
    });

    // DELETE - Remove Employee
    $(document).on("click", ".delete-btn", function () {
        let employeeId = $(this).data("id");
        let csrfToken = $('input[name="_token"]').val();

        if (confirm("Are you sure you want to delete this employee?")) {
            $.ajax({
                url: `/employees/delete/${employeeId}`,
                type: "DELETE",
                data: { _token: csrfToken },
                success: function (response) {
                    if (response.success) {
                        $(`#row-${employeeId}`).remove(); // Remove row
                    } else {
                        alert("Failed to delete employee.");
                    }
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Error deleting employee.");
                }
            });
        }
    });
});
