const getDesc = document.getElementById('description');
const toolbarOptions = [
    [{
        'header': [1, 2, 3, 4, 5, 6, false]
    }],
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote', 'code-block'],
    ['link', 'image', 'video'],
    [{
        'list': 'ordered'
    }, {
        'list': 'bullet'
    }, {
        'list': 'check'
    }],
    [{
        'script': 'sub'
    }, {
        'script': 'super'
    }], // superscript/subscript
    [{
        'indent': '-1'
    }, {
        'indent': '+1'
    }], // outdent/indent
    [{
        'direction': 'rtl'
    }], // text direction

    [{
        'color': []
    }, {
        'background': []
    }], // dropdown with defaults from theme
    [{
        'align': []
    }],

    ['clean'] // remove formatting button
];

const quill = new Quill('#quill', {
    theme: 'snow',
    placeholder: 'Enter Description',
    modules: {
        toolbar: toolbarOptions
    }
});

quill.on('editor-change', function () {
    const delta = quill.getSemanticHTML();
    getDesc.value = delta
});


// variant
document.addEventListener('DOMContentLoaded', function () {

    getDesc.value = quill.getSemanticHTML();


    const container = document.getElementById('variants-container');
    const variantTemplate = container.querySelector('.variant');

    function generateUniqueId(prefix) {
        return `${prefix}_${Math.random().toString(36).substring(2, 15)}`;
    }

    function initializeFilePond(index) {
        FilePond.registerPlugin(FilePondPluginImagePreview);

        const mediaInput = container.querySelector(`.variant[data-index="${index}"] .media-input`);
        if (mediaInput && !mediaInput.filepond) {  // Check if FilePond is not already initialized
            const uniqueId = generateUniqueId('filepond');
            mediaInput.setAttribute('id', uniqueId); // Set custom ID
            FilePond.create(mediaInput, {
                acceptedFileTypes: ['image/*'],
                allowImagePreview: true,
                allowMultiple: true,
                maxFiles: 3,
                credits: false,
                storeAsFile: true,
            });
        }
    }

    function initializeAllVariants() {
        const variants = container.querySelectorAll('.variant');
        variants.forEach((variant, index) => {
            variant.setAttribute('data-index', index);
            initializeFilePond(index);  // Initialize FilePond for each variant
        });
    }


    function applyDefaultValues() {
        const defaultPrice = document.getElementById('default_price').value;
        const defaultSalePrice = document.getElementById('default_sale_price').value;
        const defaultStock = document.getElementById('default_stock').value;
        const defaultSku = document.getElementById('default_sku').value;

        container.querySelectorAll('.variant').forEach(variant => {
            if (defaultPrice) variant.querySelector('.price-input').value = defaultPrice;
            if (defaultSalePrice) variant.querySelector('.sale-price-input').value = defaultSalePrice;
            if (defaultStock) variant.querySelector('.stock-input').value = defaultStock;
            if (defaultSku) variant.querySelector('.sku-input').value = defaultSku;
        });
    }

    // Apply default values when inputs change
    document.getElementById('default_price').addEventListener('input', applyDefaultValues);
    document.getElementById('default_sale_price').addEventListener('input', applyDefaultValues);
    document.getElementById('default_stock').addEventListener('input', applyDefaultValues);
    document.getElementById('default_sku').addEventListener('input', applyDefaultValues);


    function updateIndexes() {
        const variants = container.querySelectorAll('.variant');
        variants.forEach((variant, index) => {
            variant.setAttribute('data-index', index);

            // Update name and id attributes for each input and select
            variant.querySelectorAll('select, input').forEach(input => {
                const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                input.name = name;

                const id = input.id.replace(/_\d+$/, `_${index}`);
                input.id = id;
            });

            // Update FilePond media input ID
            const mediaInput = variant.querySelector('.media-input');
            if (mediaInput) {
                const uniqueId = generateUniqueId('filepond');
                mediaInput.setAttribute('id', uniqueId); // Set custom ID for FilePond
                mediaInput.setAttribute('name', `variants[${index}][media][]`);
            }

            // Update the for attributes of labels
            variant.querySelectorAll('label').forEach(label => {
                const htmlFor = label.getAttribute('for').replace(/_\d+$/, `_${index}`);
                label.setAttribute('for', htmlFor);
            });
        });
    }

    // Add variant functionality
    container.querySelector('.add-variant').addEventListener('click', function () {
        const newVariant = variantTemplate.cloneNode(true); // Clone the first variant
        newVariant.setAttribute('data-index', container.querySelectorAll('.variant').length); // Update index
        newVariant.querySelectorAll('select, input').forEach(input => input.value = ''); // Clear input values

        container.insertBefore(newVariant, this.closest('.d-flex')); // Insert before the Add Variant button
        updateIndexes();
        applyDefaultValues(); // Apply default values to the new variant
        initializeFilePond(newVariant.getAttribute('data-index'));  // Initialize FilePond for new variant
    });

    // Remove variant functionality
    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-variant')) {
            const variant = e.target.closest('.variant');
            variant.remove(); // Remove the variant
            updateIndexes();
        }
    });
    applyDefaultValues(); // Apply default values to the new variant
    // Initial application of FilePond setup
    initializeAllVariants(); // Initialize the first variant
});


// Thumbnail
document.getElementById('thumbnail').addEventListener('change', function (event) {
    const fileInput = event.target;
    const previewContainer = document.getElementById('thumbnai_preview');
    const previewImage = document.getElementById('thumbnail_img');
    const noThumbnailText = document.getElementById('no_thumbnail_text');

    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            noThumbnailText.style.display = 'none';
        };
        reader.readAsDataURL(file);
    } else {
        previewImage.style.display = 'none';
        noThumbnailText.style.display = 'block';
    }
});
