$(function () {
    let currentOrder = null;

    function parseShippingAddress(order) {
        try {
            return JSON.parse(order.address_id || "{}");
        } catch (e) {
            return {};
        }
    }

    function renderProducts(details) {
        let rows = "";
        (details || []).forEach(function (item, index) {
            rows += `
                <tr>
                    <td class="px-3 py-2">${index + 1}</td>
                    <td class="px-3 py-2">${item.product_name || ""}</td>
                    <td class="px-3 py-2">${item.quantity}</td>
                    <td class="px-3 py-2">₹${Number(item.unit_price).toFixed(2)}</td>
                    <td class="px-3 py-2">₹${Number(item.net_amount).toFixed(2)}</td>
                </tr>`;
        });
        $("#orderProductsBody").html(rows || `<tr><td class="px-3 py-2" colspan="5">No products</td></tr>`);
    }

    function renderSampleHistory(logs) {
        if (!logs || !logs.length) {
            $("#sampleStageHistory").html('<p class="text-gray-400">No stage updates yet.</p>');
            return;
        }
        let html = "";
        logs.forEach(function (log) {
            const date = log.created_at ? new Date(log.created_at).toLocaleString() : "";
            html += `<p><strong>${log.stage_label || log.stage}</strong> — ${date}${log.note ? " — " + log.note : ""}</p>`;
        });
        $("#sampleStageHistory").html(html);
    }

    function toggleRefundFields() {
        $("#refundFields").toggle($("#status").val() === "6");
    }

    $(document).on("click", ".viewOrderBtn", function () {
        const order = $(this).data("order");
        currentOrder = order;

        $("#idSet").val(order.id);
        $("#orderModalTitle").text("Order " + (order.order_id || ""));

        $("#orderCustomerName").text(order.user ? order.user.name : "Guest");
        $("#orderCustomerEmail").text(order.email || (order.user ? order.user.email : "—"));
        $("#orderCustomerMobile").text(order.phone || "—");

        const address = parseShippingAddress(order);
        $("#addressCustomerName").text(address.name || "—");
        $("#addressCustomerMobile").text(address.phone || "—");
        $("#addressCustomerAddress").text(address.address || "—");
        $("#addressCustomerAddressType").text(address.company_name || "—");
        $("#addressCustomerState").text(address.state || "—");
        $("#addressCustomerCity").text(address.city || "—");
        $("#addressCustomerPincode").text(address.pincode || "—");

        renderProducts(order.order_details);

        $("#orderSubtotal").text("₹" + Number(order.net_amount).toFixed(2));
        $("#orderGST").text("₹" + Number(order.gst_amount || 0).toFixed(2));
        $("#orderShipping").text("₹" + Number(order.shipping_amount || 0).toFixed(2));
        $("#orderCoupon").text("-₹" + Number(order.coupon_amount || 0).toFixed(2));
        $("#orderGrandTotal").text("₹" + Number(order.gross_amount).toFixed(2));

        $("#status").val(String(order.status));
        $("#statusDate").val(new Date().toISOString().slice(0, 10));
        $("#refundNote").val(order.refund_note || "");
        toggleRefundFields();

        $("#sampleStage").val(order.sample_stage ? String(order.sample_stage) : "");
        $("#sampleStageNote").val("");
        renderSampleHistory(order.sample_stage_logs);

        $("#orderModal").css("display", "flex");
    });

    $(document).on("change", "#status", toggleRefundFields);

    $("#cancelModalBtn").on("click", function () {
        $("#orderModal").css("display", "none");
    });

    $("#saveStatusBtn").on("click", function () {
        if (!currentOrder) return;

        const status = $("#status").val();
        const date = $("#statusDate").val();
        if (!date) {
            showToast("Please pick a date", "error", 2000);
            return;
        }
        if (status === "6" && !$("#refundNote").val().trim()) {
            showToast("Refund note is required", "error", 2000);
            return;
        }

        const formData = new FormData();
        formData.append("id", currentOrder.id);
        formData.append("order_id", currentOrder.order_id);
        formData.append("status", status);
        formData.append("date", date);
        if (status === "6") {
            formData.append("refund_note", $("#refundNote").val());
            const file = $("#refundImage")[0].files[0];
            if (file) formData.append("refund_image", file);
        }

        showLoader();
        sendRequest("/admin/orders/update-status", formData, "POST", function (res) {
            hideLoader();
            showToast(res.message, "success", 1500);
            setTimeout(() => window.location.reload(), 700);
        }, function (err) {
            hideLoader();
            showToast(err.message || "Update failed", "error", 2500);
        });
    });

    $("#saveSampleStageBtn").on("click", function () {
        if (!currentOrder) return;

        const stage = $("#sampleStage").val();
        if (!stage) {
            showToast("Please select a stage", "error", 2000);
            return;
        }

        showLoader();
        sendRequest("/admin/orders/update-sample-stage", {
            id: currentOrder.id,
            stage: stage,
            note: $("#sampleStageNote").val(),
        }, "POST", function (res) {
            hideLoader();
            showToast(res.message, "success", 1500);
            setTimeout(() => window.location.reload(), 700);
        }, function (err) {
            hideLoader();
            showToast(err.message || "Update failed", "error", 2500);
        });
    });
});
