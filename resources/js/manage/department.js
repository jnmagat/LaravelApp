import $ from "jquery";
window.$ = window.jQuery = $;

$(function () {
    const resetModal = () => {
        $("#department_id").val("");
        $("#department_name").val("");
        $("#departmentError").addClass("d-none").html("");
    };

    const showModal = (title) => {
        $("#departmentModalLabel").text(title);
        $("#departmentModal").modal("show");
    };

    // Create/Update Department
    const handleFormSubmit = (event, departmentId = null) => {
        event.preventDefault();
        
        const departmentName = $("#department_name").val();
        const csrfToken = $('input[name="_token"]').val();
        const url = departmentId ? `/departments/update/${departmentId}` : "/departments/store";
        const method = departmentId ? "PUT" : "POST";

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: csrfToken,
                department_name: departmentName,
            },
            success(response) {
                if (response.success) {
                    if (departmentId) {
                        $(`#row-${departmentId} .dept-name`).text(departmentName);
                    } else {
                        const newRow = `
                            <tr id="row-${response.department.id}">
                                <td>${response.department.id}</td>
                                <td class="dept-name">${response.department.name}</td>
                                <td>
                                 <button class="btn btn-warning btn-sm edit-btn" data-id="${response.department.id}" data-name="${response.department.name}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${response.department.id}">
                                    <i class="bi bi-trash"></i>
                                </td>
                            </tr>`;
                        $("#departmentTableBody").append(newRow);
                    }
                    $("#departmentModal").modal("hide");
                    showToast(response.message, "success");
                } else {
                    $("#departmentError").removeClass("d-none").html(response.error);
                }
            },
            error(xhr) {
                const errorMessage = xhr.responseJSON?.errors?.department_name?.[0] || "Something went wrong!";
                $("#departmentError").removeClass("d-none").html(errorMessage);
            }
        });
    };

    // Show Create Modal
    $("#addDepartmentBtn").click(function () {
        resetModal();
        showModal("Create Department");
    });

    // Show Edit Modal
    $(document).on("click", ".edit-btn", function () {
        const departmentId = $(this).data("id");
        const departmentName = $(this).data("name");
        $("#department_id").val(departmentId);
        $("#department_name").val(departmentName);
        showModal("Edit Department");
    });

    // Form submission for create/update
    $("#departmentForm").submit(function (event) {
        const departmentId = $("#department_id").val();
        handleFormSubmit(event, departmentId);
    });

    // Delete Department
    $(document).on("click", ".delete-btn", function () {
        const departmentId = $(this).data("id");
        const csrfToken = $('input[name="_token"]').val();

        if (confirm("Are you sure you want to delete this department?")) {
            $.ajax({
                url: `/departments/delete/${departmentId}`,
                type: "DELETE",
                data: { _token: csrfToken },
                success: function (response) {
                    if (response.success) {
                        $(`#row-${departmentId}`).fadeOut(300, function () {
                            $(this).remove();
                            showToast(response.message, "success");
                        });
                    }   
                },                
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON?.message || "Something went wrong!";
                    showToast(errorMessage, "danger");
                }
            });
        }
    });
});

