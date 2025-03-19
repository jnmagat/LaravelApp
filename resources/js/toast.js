export function showToast(message, type = "success") {
    let toastElement = $("#tableToast");
    let toastMessage = $("#toastMessage");
    let toastClass = type === "success" ? "bg-success" : "bg-danger";

    toastElement.removeClass("bg-success bg-danger").addClass(toastClass);
    toastMessage.html(message);
    toastElement.toast("show");
}
