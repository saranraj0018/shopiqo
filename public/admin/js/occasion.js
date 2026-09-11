$(function () {
    $(document).on("click", "#createOccasionBtn", function () {
        document.getElementById("occasionForm").reset();
        let modal = document.getElementById("occasionModal");
        let alpine = modal.__x.$data;
        alpine.previewUrl = "";
        alpine.existing_icon = "";
        alpine.form.name = "";
        alpine.form.sort_order = 0;
        alpine.form.is_active = 1;
        alpine.form.occ_id = 0;
        $("#occasionModal").css("display", "flex");
        $("#occasion_label").text("Add Occasion");
        $("#save_occ").text("Save");
    });

    $(document).on("click", ".editOccasionBtn", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");
        let sortOrder = $(this).data("sort_order");
        let isActive = $(this).data("is_active");
        let icon = $(this).data("icon");
        // open modal
        $("#occasionModal").css("display", "flex");
        $("#occasion_label").text("Edit Occasion");
        $("#save_occ").text("Update");

        // update Alpine state for preview
        let modal = document.getElementById("occasionModal");
        let alpine = modal.__x.$data;
        alpine.previewUrl = icon || "";
        alpine.existing_icon = icon || "";
        alpine.form.name = name;
        alpine.form.sort_order = sortOrder;
        alpine.form.is_active = isActive;
        alpine.form.occ_id = id;
    });

    // Use event delegation because #occasionForm may not exist initially
    $(document).on("submit", "#occasionForm", function (e) {
        e.preventDefault();
        let $saveBtn = $("#save_occ");
        // Fields to validate
        let fields = [
            {
                id: "#occasion_name",
                condition: (val) => val === "",
                message: "Occasion name is required",
            },
            {
                id: "#occasion_is_active",
                condition: (val) => val === "",
                message: "Please select status",
            }
        ];
        let isValid = true;
        for (const field of fields) {
            const result = validateField(field);
            if (!result) isValid = false;
        }

        if (!isValid) return;
        $saveBtn
            .prop("disabled", true)
            .removeClass("opacity-50 cursor-not-allowed")
            .text("Saving...");

        let formData = new FormData(this);
        showLoader();
        sendRequest(
            "/admin/occasion-save",
            formData,
            "POST",
            function (res) {
                hideLoader();
                if (res.success) {
                    showToast(res.message, "success", 2000);
                    setTimeout(() => {
                        $("#occasionModal").hide();
                        let modal = document.querySelector("#occasionModal");
                        let alpine = modal.__x.$data;
                        alpine.form = { name: "", sort_order: 0, is_active: "1" };
                        alpine.previewUrl = null;
                        document.getElementById("occasionForm").reset();

                        $.get("/admin/occasion-list", function (html) {
                            let $tbody = $(html)
                                .find("#occasionTableBody")
                                .html();
                            $("#occasionTableBody").html($tbody);
                        });
                    }, 500);
                } else {
                    showToast("Something went wrong!", "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
            function (err) {
                hideLoader();
                if (err.errors) {
                    let msg = "";
                    $.each(err.errors, function (k, v) {
                        msg += v[0] + "<br>";
                    });
                    showToast(msg, "error", 2000);
                } else {
                    showToast(err.message || "Unexpected error", "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
        );
    });

    // ==== DELETE =====
    $(document).on("click", ".btnDeleteOccasion", function () {
        let id = $(this).data("id");
        let modalScope = document.querySelector("#deleteOccasionModal").__x
            .$data;
        modalScope.deleteId = id;
        modalScope.open = true;
    });

    window.deleteOccasion = function (id) {
        showLoader();
        sendRequest(
            "/admin/occasion-delete",
            { id: id },
            "POST",
            function (res) {
                hideLoader();
                if (res.success) {
                    showToast(
                        "Occasion deleted successfully!",
                        "success",
                        2000,
                    );
                    reloadOccasionList();
                } else {
                    showToast(res.message, "error", 2000);
                }
                document.querySelector("#deleteOccasionModal").__x.$data.open =
                    false;
            },
            function (err) {
                hideLoader();
                showToast(err.message || "Delete failed", "error", 2000);
                document.querySelector("#deleteOccasionModal").__x.$data.open =
                    false;
            },
        );
    };

    // ===== Helpers =====
    function reloadOccasionList() {
        $.get("/admin/occasion-list", function (html) {
            let $tbody = $(html).find("#occasionTableBody").html();
            $("#occasionTableBody").html($tbody);
        });
    }
});
