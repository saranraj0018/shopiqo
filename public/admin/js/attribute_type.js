$(function () {
    $(document).on("click", "#createAttributeBtn", function () {
        document.getElementById("attributeForm").reset();
        let modal = document.getElementById("attributeModal");
        let alpine = modal.__x.$data;
        alpine.form.attribute_id = "";
        alpine.form.attribute_name = "";
        $("#attributeModal").css("display", "flex");
        $("#attribute_label").text("Add Attribute Type");
        $("#save_attribute").text("Save");
    });

    $(document).on("click", ".editAttributeBtn", function () {
        let attribute = $(this).data("attribute_id");
        let attribute_name = $(this).data("attribute_name");

        // open modal
        $("#attributeModal").css("display", "flex");
        $("#attribute_label").text("Edit Attribute Type");
        $("#save_attribute").text("Update");

        // update Alpine state for preview
        let modal = document.getElementById("attributeModal");
        let alpine = modal.__x.$data;
        alpine.form.attribute_name = attribute_name;
        alpine.form.attribute_id = attribute;
    });

    $(document).on("submit", "#attributeForm", function (e) {
        e.preventDefault();
        let $saveBtn = $("#save_attribute");
        let attributeName = $("#attribute_name").val().trim();
        let fields = [
            {
                id: "#attribute_name",
                condition: (val) => val === "",
                message: "Attribute Name is required",
            },
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
            "/admin/attribute-type-save",
            formData,
            "POST",
            function (res) {
                hideLoader();
                if (res.success) {
                    showToast(res.message, "success", 2000);
                    setTimeout(() => {
                        $("#attributeModal").hide();
                        let modal = document.querySelector("#attributeModal");
                        let alpine = modal.__x.$data;
                        alpine.form = {
                            attribute_id: "",
                            attribute_name: "",
                        };
                        document.getElementById("attributeForm").reset();
                        $.get("/admin/attribute-type", function (html) {
                            let $tbody = $(html)
                                .find("#attributeTableBody")
                                .html();
                            $("#attributeTableBody").html($tbody);
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
});
