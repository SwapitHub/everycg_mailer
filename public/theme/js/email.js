'use strict';

(function () {

    // select2
    if (document.querySelector(".compose-multiple-select")) {
        $(".compose-multiple-select").select2();
    }

    // easymde editor
    const easyMdeEditorEl = document.querySelector('#easyMdeEditor');
    if (easyMdeEditorEl) {
        var easymde = new EasyMDE({
            element: easyMdeEditorEl
        });
    }


    const easyEditor = document.querySelector('.easyMdeEditor');
    if (easyEditor) {
        var easymde = new EasyMDE({
            element: easyEditor
        });
    }


    let selectedIds = [];

    const inboxCheckAll = document.querySelector('#inboxCheckAll');
    const draftCheckboxes = document.querySelectorAll('.draft-checkbox');

    // Select All / Deselect All
    if (inboxCheckAll) {
        inboxCheckAll.addEventListener('change', function () {
            selectedIds = [];
            draftCheckboxes.forEach(function (checkbox) {
                checkbox.checked = inboxCheckAll.checked;

                if (inboxCheckAll.checked) {
                    const id = checkbox.dataset.id;
                    selectedIds.push(id);
                }
            });

            if (!inboxCheckAll.checked) {
                selectedIds = [];
            }

            console.log("Select All IDs:", selectedIds);
        });
    }

    // Individual selection
    draftCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const id = this.dataset.id;

            if (this.checked) {
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            } else {
                selectedIds = selectedIds.filter(i => i !== id);
            }

            // If any checkbox is unchecked, uncheck "Select All"
            if (!this.checked && inboxCheckAll.checked) {
                inboxCheckAll.checked = false;
            }
        });
    });

    // Delete selected drafts
    document.querySelector("#deleteDrafts").addEventListener('click', function () {
        if (selectedIds.length === 0) {
            alert("Please select at least one draft to delete.");
            return;
        }

        const button = this;
        button.disabled = true;
        button.textContent = "Loading...";

        selectedIds.forEach(function (id) {
            const url = window.deleteDraftUrl.replace('__ID__', id);

            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    const item = document.getElementById('draft-' + id);
                    if (item) {
                        item.closest('.email-list-item').remove();
                        // remove deleted count from selectedIds
                    }
                    // Update count
                    const countElement = document.getElementById('draft-count');
                    if (countElement) {
                        let currentCount = parseInt(countElement.textContent);
                        if (!isNaN(currentCount) && currentCount > 0) {
                            countElement.textContent = currentCount - 1;
                        }
                    }
                    // Remove deleted ID from selectedIds
                    selectedIds = selectedIds.filter(did => did !== id);
                },
                error: function () {
                    alert("Failed to delete draft with ID: " + id);
                },
                complete: function () {
                    // Reset button after last request finishes
                    button.disabled = false;
                    button.textContent = "Delete";
                }
            });
        });

        selectedIds = [];
        inboxCheckAll.checked = false;
    });




})();
