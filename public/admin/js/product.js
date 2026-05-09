$(document).ready(function () {
    /*=================================================================
      STATE
    =================================================================*/
    let variantIndex = 0;
    let bulkIndex = 1;
    let currentStep = 1;
    let galleryFiles = new DataTransfer();

    /*=================================================================
      OPEN MODAL — CREATE
    =================================================================*/
    $("#createProductBtn").on("click", function () {
        resetProductForm();
        $("#product_label").text("Add Product");
        $("#save_product").text("Save");
        showStep(1);
        $("#productModal").removeClass("hidden");
    });

    /*=================================================================
      CLOSE MODAL
    =================================================================*/
    $("#closeProductModal").on("click", function () {
        $("#productModal").addClass("hidden");
    });

    /*=================================================================
      STEP NAVIGATION
    =================================================================*/
    function showStep(n) {
        currentStep = n;
        $(".step").addClass("hidden");
        $(".step-" + n).removeClass("hidden");

        $(".step-indicator").each(function () {
            const s = parseInt($(this).data("step"));
            $(this)
                .toggleClass("bg-black text-white", s === n)
                .toggleClass("bg-gray-200 text-gray-500", s !== n);
        });

        $("#prevBtn").toggleClass("hidden", n === 1);
        $("#nextBtn").toggleClass("hidden", n === 3);
        $("#save_product").toggleClass("hidden", n !== 3);
    }

    $("#nextBtn").on("click", function () {
        if (currentStep < 3) showStep(currentStep + 1);
    });

    $("#prevBtn").on("click", function () {
        if (currentStep > 1) showStep(currentStep - 1);
    });

    /*=================================================================
      CATEGORY → SUB-CATEGORY
    =================================================================*/
    $(document).on("change", "#category_id", function () {
        const category_id = $(this).val();
        $("#sub_category_id").html(
            '<option value="">Select Sub Category</option>',
        );
        if (!category_id) return;

        $.ajax({
            url: "/admin/product-list",
            type: "GET",
            dataType: "json",
            data: { category_id: category_id, get_sub_category: true },
            success: function (resp) {
                if (resp.success && resp.sub_category.length) {
                    resp.sub_category.forEach(function (sub) {
                        $("#sub_category_id").append(
                            `<option value="${sub.id}">${sub.name}</option>`,
                        );
                    });
                }
            },
            error: function () {
                showToast("Unable to fetch sub categories!", "error", 2000);
            },
        });
    });

    /*=================================================================
      PRODUCT TYPE TOGGLE
    =================================================================*/
    $(document).on("change", "#product_type", function () {
        const type = $(this).val();
        $("#singleFields, #variantFields, #bulkFields").addClass("hidden");

        if (type === "single") $("#singleFields").removeClass("hidden");

        if (type === "variant") {
            $("#variantFields").removeClass("hidden");
            const primAttr = $("#primary_variant").val();
            if (primAttr) buildFirstVariantRow(primAttr);
        }

        if (type === "bulk") {
            $("#bulkFields").removeClass("hidden");
            $(".select2").select2({
                placeholder: "Select values",
                allowClear: true,
                width: "100%",
            });
        }
    });

    /*=================================================================
      PRIMARY ATTRIBUTE CHANGE → rebuild variant rows
    =================================================================*/
    $(document).on("change", "#primary_variant", function () {
        const id = $(this).val();
        if (!id) {
            $("#variantWrapper").html("");
            variantIndex = 0;
            return;
        }
        buildFirstVariantRow(id);
    });

    /*=================================================================
      BUILD FIRST VARIANT ROW (index 0, no Remove button)
    =================================================================*/
    function buildFirstVariantRow(attributeTypeId) {
        loadVariantOptions(
            attributeTypeId,
            function (primaryHtml, secondaryHtml) {
                $("#variantWrapper").html(
                    makeVariantRowHtml(0, primaryHtml, secondaryHtml, false),
                );
                variantIndex = 1;
            },
        );
    }

    /*=================================================================
      ADD VARIANT ROW
    =================================================================*/
    $("#addVariant").on("click", function () {
        const attributeTypeId = $("#primary_variant").val();
        if (!attributeTypeId) {
            showToast(
                "Please select a primary attribute first!",
                "error",
                2000,
            );
            return;
        }
        loadVariantOptions(
            attributeTypeId,
            function (primaryHtml, secondaryHtml) {
                $("#variantWrapper").append(
                    makeVariantRowHtml(
                        variantIndex,
                        primaryHtml,
                        secondaryHtml,
                        true,
                    ),
                );
                variantIndex++;
            },
        );
    });

    $(document).on("click", ".removeVariant", function () {
        $(this).closest(".variant-row").remove();
    });

    /*=================================================================
      VARIANT ROW HTML
    =================================================================*/
    function makeVariantRowHtml(
        idx,
        primaryHtml,
        secondaryHtml,
        showRemove,
        data,
    ) {
        // data is optional — used when rebuilding rows in edit mode
        data = data || {};
        return `
        <div class="variant-row grid grid-cols-7 gap-3 mb-4 items-start">
            <div>
                <select name="variants[${idx}][primary_value]"
                        class="border rounded-xl px-3 py-2 w-full primaryValue">
                    ${primaryHtml}
                </select>
            </div>
            <div>
                <select name="variants[${idx}][secondary_value]"
                        class="border rounded-xl px-3 py-2 w-full secondaryValue">
                    ${secondaryHtml}
                </select>
            </div>
            <div>
                <input type="number" step="0.01" min="0"
                       name="variants[${idx}][regular_price]"
                       placeholder="Regular Price"
                       value="${data.regular_price || ""}"
                       class="regular_price border rounded-xl px-3 py-2 w-full">
            </div>
            <div>
                <input type="number" step="0.01" min="0"
                       name="variants[${idx}][sale_price]"
                       placeholder="Sale Price"
                       value="${data.sale_price || ""}"
                       class="sale_price border rounded-xl px-3 py-2 w-full">
            </div>
            <div>
                <input type="number" min="0"
                       name="variants[${idx}][stock]"
                       placeholder="Stock"
                       value="${data.stock || ""}"
                       class="stock border rounded-xl px-3 py-2 w-full">
            </div>
            <div>
                <input type="hidden"
                       name="variants[${idx}][existing_image]"
                       value="${data.existing_image || ""}"
                       class="existingVariantImage">
                <input type="file"
                       name="variants[${idx}][image]"
                       class="variantImage border rounded-xl px-3 py-2 w-full"
                       accept="image/*">
                <img class="variantImagePreview mt-2 w-16 h-16 object-cover rounded hidden">
                ${
                    data.existing_image
                        ? `<img src="/storage/${data.existing_image}"
                               class="existingVariantThumb w-16 h-16 mt-2 rounded object-cover border">`
                        : ""
                }
            </div>
            <div class="flex items-center">
                ${
                    showRemove
                        ? `<button type="button"
                               class="removeVariant bg-red-500 text-white px-3 py-2 rounded-xl text-sm">
                           Remove
                       </button>`
                        : ""
                }
            </div>
        </div>`;
    }

    /*=================================================================
      LOAD VARIANT OPTIONS (parallel AJAX)
    =================================================================*/
    function loadVariantOptions(attributeTypeId, callback) {
        let primaryHtml = "",
            secondaryHtml = "",
            done = 0;

        function check() {
            if (++done === 2) callback(primaryHtml, secondaryHtml);
        }

        $.get("/admin/get-variant-values/" + attributeTypeId, function (res) {
            primaryHtml = '<option value="">Select</option>';
            res.forEach(function (v) {
                primaryHtml += `<option value="${v.id}">${v.value}</option>`;
            });
            check();
        });

        $.get("/admin/get-secondary-values/" + attributeTypeId, function (res) {
            secondaryHtml = '<option value="">None</option>';
            res.forEach(function (v) {
                secondaryHtml += `<option value="${v.id}">${v.value}</option>`;
            });
            check();
        });
    }

    /*=================================================================
      VARIANT IMAGE PREVIEW
    =================================================================*/
    $(document).on("change", ".variantImage", function () {
        const preview = $(this).siblings(".variantImagePreview");
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.attr("src", e.target.result).removeClass("hidden");
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    /*=================================================================
      ADD / REMOVE BULK ROW
    =================================================================*/
    $("#addBulk").on("click", function () {
        $("#bulkWrapper").append(`
        <div class="bulk-row grid grid-cols-5 gap-3 mb-3">
            <div>
                <input type="number" min="1" name="bulk[${bulkIndex}][minimum]"
                       placeholder="Min Qty" class="minimum w-full border rounded-xl px-3 py-2">
            </div>
            <div>
                <input type="number" min="1" name="bulk[${bulkIndex}][maximum]"
                       placeholder="Max Qty" class="maximum w-full border rounded-xl px-3 py-2">
            </div>
            <div>
                <input type="number" step="0.01" min="0" name="bulk[${bulkIndex}][regular_price]"
                       placeholder="Regular Price" class="bulk_regular_price w-full border rounded-xl px-3 py-2">
            </div>
            <div>
                <input type="number" step="0.01" min="0" name="bulk[${bulkIndex}][sale_price]"
                       placeholder="Sale Price" class="bulk_sale_price w-full border rounded-xl px-3 py-2">
            </div>
            <div class="flex items-center">
                <button type="button" class="removeBulk bg-red-500 text-white px-3 py-2 rounded-xl text-sm">
                    Remove
                </button>
            </div>
        </div>`);
        bulkIndex++;
    });

    $(document).on("click", ".removeBulk", function () {
        $(this).closest(".bulk-row").remove();
    });

    /*=================================================================
      MAIN IMAGE — choose / preview / remove
    =================================================================*/
    $(document).on("click", ".choose-image-btn", function () {
        $(this).closest(".image-wrapper").find("input[type=file]").click();
    });

    $(document).on("change", "#mainImage", function () {
        if (!this.files || !this.files[0]) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            $(".image-preview")
                .removeClass("hidden")
                .find(".preview-img")
                .attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on("click", ".remove-image-btn", function () {
        $(".image-preview")
            .addClass("hidden")
            .find(".preview-img")
            .attr("src", "");
        $("#mainImage").val("");
        $("#existing_main").val("");
    });

    /*=================================================================
      GALLERY — choose / preview / remove
    =================================================================*/
    $(document).on("change", "#galleryImage", function () {
        const preview = $(".gallery-preview");

        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];
            const fileIndex = galleryFiles.items.length;
            galleryFiles.items.add(file);

            const reader = new FileReader();
            reader.onload = (function (idx) {
                return function (e) {
                    preview.append(`
                    <div class="relative image-box" data-index="${idx}">
                        <img src="${e.target.result}" class="w-24 h-24 object-cover rounded border">
                        <button type="button"
                                class="remove-gallery absolute -top-2 -right-2
                                       bg-red-500 text-white w-6 h-6 rounded-full text-xs leading-none">
                            ×
                        </button>
                    </div>`);
                };
            })(fileIndex);
            reader.readAsDataURL(file);
        }

        $("#galleryImage")[0].files = galleryFiles.files;
    });

    $(document).on("click", ".remove-gallery", function () {
        const box = $(this).closest(".image-box");
        const removeIdx = parseInt(box.data("index"));
        const dt = new DataTransfer();

        for (let i = 0; i < galleryFiles.files.length; i++) {
            if (i !== removeIdx) dt.items.add(galleryFiles.files[i]);
        }

        galleryFiles = dt;
        box.remove();

        // Re-index remaining boxes
        $(".gallery-preview .image-box").each(function (newIdx) {
            $(this).data("index", newIdx);
        });

        $("#galleryImage")[0].files = galleryFiles.files;
    });

    // Remove existing (persisted) gallery image
    $(document).on("click", ".removeGallery", function () {
        $(this).closest(".gallery-item").remove();
    });

    /*=================================================================
      FORM SUBMIT (Create + Update)
    =================================================================*/
    $(document).on("submit", "#productForm", function (e) {
        e.preventDefault();

        $(".error-message, .image-error").remove();
        $("#productForm")
            .find("input, select, textarea")
            .removeClass("border-red-500 ring-1 ring-red-500");

        let isValid = true;
        const isNew = !$("input[name='product_id']").val();

        // Step 1
        const $name = $("#product_name");
        const $code = $("#product_code");
        const $category = $("#category_id");

        if (!$.trim($name.val())) {
            showError($name, "Required");
            showToast("Product Name is required", "error", 2000);
            isValid = false;
        } else clearError($name);
        if (!$.trim($code.val())) {
            showError($code, "Required");
            showToast("Product Code is required", "error", 2000);
            isValid = false;
        } else clearError($code);
        if (!$.trim($category.val())) {
            showError($category, "Required");
            showToast("Please select a category", "error", 2000);
            isValid = false;
        } else clearError($category);

        // Main image
        const hasNewMain =
            $("#mainImage")[0] && $("#mainImage")[0].files.length > 0;
        const hasExistingMain = $.trim($("#existing_main").val()) !== "";
        if (!hasNewMain && !hasExistingMain) {
            showToast("Main Image is required!", "error", 2000);
            $("#mainImage")
                .closest(".image-wrapper")
                .append(
                    '<div class="image-error text-red-500 text-sm mt-2">Main image is required</div>',
                );
            isValid = false;
        }

        // Step 2
        const $type = $("#product_type");
        const type = $type.val();
        if (!type) {
            showError($type, "Required");
            showToast("Please select a product type", "error", 2000);
            isValid = false;
        } else clearError($type);

        // Single
        if (type === "single") {
            const $reg = $(".single_regular_price");
            const $stock = $(".single_stock");
            if (!$.trim($reg.val())) {
                showError($reg, "Required");
                showToast("Regular Price is required", "error", 2000);
                isValid = false;
            } else clearError($reg);
            if (!$.trim($stock.val())) {
                showError($stock, "Required");
                showToast("Stock is required", "error", 2000);
                isValid = false;
            } else clearError($stock);
        }

        // Variant
        if (type === "variant") {
            const $prim = $("#primary_variant");
            if (!$.trim($prim.val())) {
                showError($prim, "Required");
                showToast(
                    "Please select a primary variant attribute",
                    "error",
                    2000,
                );
                isValid = false;
            } else clearError($prim);

            if ($("#variantWrapper .variant-row").length === 0) {
                showToast("Add at least one variant row", "error", 2000);
                isValid = false;
            }

            $("#variantWrapper .variant-row").each(function () {
                const $pv = $(this).find(".primaryValue");
                const $reg = $(this).find(".regular_price");
                const $sale = $(this).find(".sale_price");
                const $stk = $(this).find(".stock");
                const $img = $(this).find(".variantImage");
                const $eImg = $(this).find(".existingVariantImage");

                if (!$.trim($pv.val())) {
                    showError($pv, "Required");
                    showToast(
                        "Primary Value required for all variants",
                        "error",
                        2000,
                    );
                    isValid = false;
                } else clearError($pv);
                if (!$.trim($reg.val())) {
                    showError($reg, "Required");
                    showToast(
                        "Regular Price required for all variants",
                        "error",
                        2000,
                    );
                    isValid = false;
                } else clearError($reg);
                if (!$.trim($sale.val())) {
                    showError($sale, "Required");
                    showToast(
                        "Sale Price required for all variants",
                        "error",
                        2000,
                    );
                    isValid = false;
                } else clearError($sale);
                if (!$.trim($stk.val())) {
                    showError($stk, "Required");
                    showToast("Stock required for all variants", "error", 2000);
                    isValid = false;
                } else clearError($stk);

                // On create: file required. On update: existing image is acceptable.
                if (!$img.val() && !$.trim($eImg.val())) {
                    showError($img, "Image required");
                    showToast("Image required for all variants", "error", 2000);
                    isValid = false;
                } else clearError($img);
            });
        }

        // Bulk
        if (type === "bulk") {
            if ($("#bulkWrapper .bulk-row").length === 0) {
                showToast("Add at least one price range", "error", 2000);
                isValid = false;
            }

            $("#bulkWrapper .bulk-row").each(function () {
                const $min = $(this).find(".minimum");
                const $max = $(this).find(".maximum");
                const $reg = $(this).find(".bulk_regular_price");
                const $sale = $(this).find(".bulk_sale_price");

                if (!$.trim($min.val())) {
                    showError($min, "Required");
                    showToast("Minimum Qty is required", "error", 2000);
                    isValid = false;
                } else clearError($min);
                if (!$.trim($max.val())) {
                    showError($max, "Required");
                    showToast("Maximum Qty is required", "error", 2000);
                    isValid = false;
                } else clearError($max);
                if (!$.trim($reg.val())) {
                    showError($reg, "Required");
                    showToast("Regular Price is required", "error", 2000);
                    isValid = false;
                } else clearError($reg);
                if (!$.trim($sale.val())) {
                    showError($sale, "Required");
                    showToast("Sale Price is required", "error", 2000);
                    isValid = false;
                } else clearError($sale);

                if (
                    $.trim($min.val()) &&
                    $.trim($max.val()) &&
                    parseInt($max.val()) < parseInt($min.val())
                ) {
                    showError($max, "Max must be ≥ Min");
                    showToast("Maximum must be ≥ Minimum", "error", 2000);
                    isValid = false;
                }
            });
        }

        // Gallery
        const newGallery = galleryFiles.files.length;
        const existingGallery = $(".existing_gallery").filter(function () {
            return $.trim($(this).val()) !== "";
        }).length;

        if (newGallery === 0 && existingGallery === 0) {
            showToast("At least one gallery image is required", "error", 2000);
            $("#galleryImage")
                .closest(".image-wrapper")
                .append(
                    '<div class="image-error text-red-500 text-sm mt-2">At least one gallery image is required</div>',
                );
            isValid = false;
        }

        if (!isValid) return;

        const formData = new FormData(this);
        showLoader();

        sendRequest(
            "/admin/save-product",
            formData,
            "POST",
            function (res) {
                hideLoader();
                if (res.success) {
                    showToast("Product saved successfully!", "success", 2000);
                    setTimeout(function () {
                        window.location.reload();
                    }, 600);
                } else {
                    showToast(res.message || "Save failed", "error", 2000);
                }
            },
            function (err) {
                hideLoader();
                if (err.errors) {
                    let msg = "";
                    $.each(err.errors, function (k, v) {
                        msg += v[0] + "<br>";
                    });
                    showToast(msg, "error", 3000);
                } else {
                    showToast(err.message || "Unexpected error", "error", 2000);
                }
            },
        );
    });

    /*=================================================================
      EDIT PRODUCT
      Bulk data is now in product.product_variant rows where
      minimum / maximum are NOT null (pri_attribute_id is null).
      Variant data is in rows where pri_attribute_id is NOT null.
    =================================================================*/
    $(document).on("click", ".editProductBtn", function () {
        resetProductForm();
        showStep(1);

        const product = $(this).data("product");

        $("#product_label").text("Edit Product");
        $("#save_product").text("Update");
        $("#productModal").removeClass("hidden");

        // Basic fields
        $("input[name='product_id']").val(product.id);
        $("#product_name").val(product.name);
        $("#product_code").val(product.product_code);
        $("#category_id").val(product.category_id).trigger("change");
        $("#product_type").val(product.product_type).trigger("change");
        $("textarea[name='description']").val(product.description);
        $("#production_min_days").val(product.production_min_days || "");
        $("#production_max_days").val(product.production_max_days || "");

        // Sub-category — wait for AJAX to populate the option
        if (product.sub_category_id) {
            const checkSub = setInterval(function () {
                if (
                    $(
                        "#sub_category_id option[value='" +
                            product.sub_category_id +
                            "']",
                    ).length
                ) {
                    $("#sub_category_id").val(product.sub_category_id);
                    clearInterval(checkSub);
                }
            }, 100);
        }

        // Main image
        if (product.main_image) {
            $("#existing_main").val(product.main_image);
            $(".image-preview")
                .removeClass("hidden")
                .find(".preview-img")
                .attr("src", "/storage/" + product.main_image);
        }

        // Single
        if (product.product_type === "single") {
            $(".single_regular_price").val(product.regular_price);
            $(".single_sale_price").val(product.sale_price);
            $(".single_stock").val(product.stock);
        }

        /*--------------------------------------------------------------
         | VARIANT edit
         | product_variant rows where pri_attribute_id IS NOT NULL
         |--------------------------------------------------------------*/
        if (
            product.product_type === "variant" &&
            product.product_variant &&
            product.product_variant.length
        ) {
            // Filter to only real variant rows (exclude bulk rows)
            const variantRows = product.product_variant.filter(function (pv) {
                return pv.pri_attribute_id !== null;
            });

            if (variantRows.length) {
                const primaryAttributeId = variantRows[0].pri_attribute_id;
                $("#primary_variant").val(primaryAttributeId);

                loadVariantOptions(
                    primaryAttributeId,
                    function (primaryHtml, secondaryHtml) {
                        $("#variantWrapper").html("");
                        variantIndex = 0;

                        variantRows.forEach(function (v, index) {
                            let primaryValueId = "";
                            let secondaryValueId = "";

                            if (v.variant_values && v.variant_values.length) {
                                v.variant_values.forEach(function (vv) {
                                    if (
                                        String(vv.attribute_id) ===
                                        String(primaryAttributeId)
                                    ) {
                                        primaryValueId = vv.attribute_value_id;
                                    } else {
                                        secondaryValueId =
                                            vv.attribute_value_id;
                                    }
                                });
                            }

                            const rowHtml = makeVariantRowHtml(
                                index,
                                primaryHtml,
                                secondaryHtml,
                                index !== 0,
                                {
                                    regular_price: v.regular_price,
                                    sale_price: v.sale_price,
                                    stock: v.stock,
                                    existing_image: v.cover_image || "",
                                },
                            );

                            $("#variantWrapper").append(rowHtml);

                            // Set selects AFTER appending to DOM
                            $(
                                `select[name="variants[${index}][primary_value]"]`,
                            ).val(primaryValueId);
                            $(
                                `select[name="variants[${index}][secondary_value]"]`,
                            ).val(secondaryValueId);
                            variantIndex++;
                        });
                    },
                );
            }
        }

        /*--------------------------------------------------------------
         | BULK edit
         | Bulk rows are product_variant rows where pri_attribute_id IS NULL
         | and minimum / maximum are filled.
         | Attribute selections come from variant_values on each row.
         |--------------------------------------------------------------*/
        if (
            product.product_type === "bulk" &&
            product.product_variant &&
            product.product_variant.length
        ) {
            // Filter to only bulk rows
            const bulkRows = product.product_variant.filter(function (pv) {
                return pv.pri_attribute_id === null && pv.minimum !== null;
            });

            // Collect all attribute selections (union across all rows — they share same attributes)
            const allAttributes = {}; // { attributeTypeId: [value_ids] }

            $("#bulkWrapper").html(""); // clear the default first row
            bulkIndex = 0;

            bulkRows.forEach(function (b, index) {
                const removeBtn =
                    index !== 0
                        ? `<button type="button"
                               class="removeBulk bg-red-500 text-white px-3 py-2 rounded-xl text-sm">
                           Remove
                       </button>`
                        : "";

                $("#bulkWrapper").append(`
                <div class="bulk-row grid grid-cols-5 gap-3 mb-3">
                    <div>
                        <input type="number" min="1"
                               name="bulk[${index}][minimum]"
                               value="${b.minimum}"
                               class="minimum w-full border rounded-xl px-3 py-2">
                    </div>
                    <div>
                        <input type="number" min="1"
                               name="bulk[${index}][maximum]"
                               value="${b.maximum}"
                               class="maximum w-full border rounded-xl px-3 py-2">
                    </div>
                    <div>
                        <input type="number" step="0.01" min="0"
                               name="bulk[${index}][regular_price]"
                               value="${b.regular_price}"
                               class="bulk_regular_price w-full border rounded-xl px-3 py-2">
                    </div>
                    <div>
                        <input type="number" step="0.01" min="0"
                               name="bulk[${index}][sale_price]"
                               value="${b.sale_price}"
                               class="bulk_sale_price w-full border rounded-xl px-3 py-2">
                    </div>
                    <div class="flex items-center">${removeBtn}</div>
                </div>`);

                bulkIndex = index + 1;

                // Collect attribute values from variant_values of this bulk row
                if (b.variant_values && b.variant_values.length) {
                    b.variant_values.forEach(function (vv) {
                        const attrId = vv.attribute_id;
                        if (!allAttributes[attrId]) allAttributes[attrId] = [];
                        if (
                            !allAttributes[attrId].includes(
                                vv.attribute_value_id,
                            )
                        ) {
                            allAttributes[attrId].push(vv.attribute_value_id);
                        }
                    });
                }
            });

            bulkIndex++;

            // Apply selections to select2 dropdowns
            Object.keys(allAttributes).forEach(function (attrId) {
                $(`select[name="bulk_attributes[${attrId}][]"]`)
                    .val(allAttributes[attrId])
                    .trigger("change");
            });
        }

        // Gallery
        if (
            product.product_gallery_image &&
            product.product_gallery_image.length
        ) {
            product.product_gallery_image.forEach(function (g) {
                $(".gallery-preview").append(`
                <div class="relative gallery-item">
                    <input type="hidden" name="existing_gallery[]"
                           value="${g.image_path}" class="existing_gallery">
                    <img src="/storage/${g.image_path}"
                         class="h-24 w-24 rounded object-cover border">
                    <button type="button"
                            class="removeGallery absolute -top-2 -right-2
                                   bg-red-600 text-white rounded-full w-6 h-6 text-xs">
                        ×
                    </button>
                </div>`);
            });
        }
    });

    /*=================================================================
      RESET FORM
    =================================================================*/
    function resetProductForm() {
        $("#productForm")[0].reset();
        $("input[name='product_id']").val("");
        $("#existing_main").val("");

        $("#variantWrapper").html("");
        $("#bulkWrapper").html(`
        <div class="bulk-row grid grid-cols-5 gap-3 mb-3">
            <div><input type="number" min="1" name="bulk[0][minimum]" placeholder="Min Qty" class="minimum w-full border rounded-xl px-3 py-2"></div>
            <div><input type="number" min="1" name="bulk[0][maximum]" placeholder="Max Qty" class="maximum w-full border rounded-xl px-3 py-2"></div>
            <div><input type="number" step="0.01" min="0" name="bulk[0][regular_price]" placeholder="Regular Price" class="bulk_regular_price w-full border rounded-xl px-3 py-2"></div>
            <div><input type="number" step="0.01" min="0" name="bulk[0][sale_price]" placeholder="Sale Price" class="bulk_sale_price w-full border rounded-xl px-3 py-2"></div>
            <div></div>
        </div>`);

        $(".gallery-preview").html("");
        galleryFiles = new DataTransfer();

        $("#singleFields, #variantFields, #bulkFields").addClass("hidden");
        $(".image-preview")
            .addClass("hidden")
            .find(".preview-img")
            .attr("src", "");
        $("input[type='file']").val("");
        $(".error-message, .image-error").remove();
        $("#productForm")
            .find("input, select, textarea")
            .removeClass("border-red-500 ring-1 ring-red-500");
        $("#sub_category_id").html(
            '<option value="">Select Sub Category</option>',
        );

        variantIndex = 0;
        bulkIndex = 1;
    }

    /*=================================================================
      ERROR HELPERS
    =================================================================*/
    function showError(el, message) {
        el.addClass("border-red-500 ring-1 ring-red-500");
        if (!el.next(".error-message").length) {
            el.after(
                `<div class="error-message text-red-500 text-xs mt-1">${message}</div>`,
            );
        }
    }

    function clearError(el) {
        el.removeClass("border-red-500 ring-1 ring-red-500");
        el.next(".error-message").remove();
    }

    /*=================================================================
      SELECT2 INIT
    =================================================================*/
    $(".select2").select2({
        placeholder: "Select values",
        allowClear: true,
        width: "100%",
    });
});
