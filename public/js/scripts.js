document.addEventListener('DOMContentLoaded', function() {
    // Initialize collection handlers
    function initCollection(collectionClass, addButtonClass, removeButtonClass) {
        const addButton = document.querySelector(`.${addButtonClass}`);
        if (!addButton) return;

        addButton.addEventListener('click', function(e) {
            e.preventDefault();
            const collectionHolder = document.querySelector(`.${collectionClass}`);
            const index = collectionHolder.dataset.index;
            const prototype = collectionHolder.dataset.prototype;

            const newItem = document.createElement('div');
            newItem.classList.add(`${collectionClass}-item`, 'mb-3', 'p-3', 'border', 'rounded');
            newItem.innerHTML = prototype.replace(/__name__/g, index);

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.classList.add('btn', 'btn-sm', 'btn-danger', removeButtonClass);
            removeBtn.textContent = 'Remove';
            removeBtn.addEventListener('click', function() {
                newItem.remove();
            });

            newItem.appendChild(removeBtn);
            collectionHolder.appendChild(newItem);

            collectionHolder.dataset.index = parseInt(index) + 1;
        });

        document.querySelectorAll(`.${removeButtonClass}`).forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest(`.${collectionClass}-item`).remove();
            });
        });
    }

    // Initialize all collections
    initCollection('education-collection', 'add-education', 'remove-education');
    initCollection('experience-collection', 'add-experience', 'remove-experience');
    initCollection('language-collection', 'add-language', 'remove-language');
    initCollection('project-collection', 'add-project', 'remove-project');
    initCollection('social-collection', 'add-social', 'remove-social');

    // Date picker enhancement
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        if (!input.value) {
            const today = new Date().toISOString().split('T')[0];
            input.value = today;
        }
    });
});