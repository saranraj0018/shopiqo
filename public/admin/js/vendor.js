$(function () {
    function reloadVendorList() {
        $.get("/admin/vendor-list", function (html) {
            let $tbody = $(html).find("#vendorTableBody").html();
            $("#vendorTableBody").html($tbody);
        });
    }

    $(document).on("click", ".btnApproveVendor", function () {
        let id = $(this).data("id");
        showLoader();
        sendRequest(
            "/admin/vendor-approve",
            { id: id },
            "POST",
            function (res) {
                hideLoader();
                showToast(res.message, "success", 2000);
                reloadVendorList();
            },
            function (err) {
                hideLoader();
                showToast(err.message || "Approve failed", "error", 2000);
            },
        );
    });

    $(document).on("click", ".btnRejectVendor", function () {
        let id = $(this).data("id");
        if (!confirm("Reject and remove this vendor application?")) return;
        showLoader();
        sendRequest(
            "/admin/vendor-reject",
            { id: id },
            "POST",
            function (res) {
                hideLoader();
                showToast(res.message, "success", 2000);
                reloadVendorList();
            },
            function (err) {
                hideLoader();
                showToast(err.message || "Reject failed", "error", 2000);
            },
        );
    });
});
