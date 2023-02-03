window.onload = function () {
    const imageInput = document.getElementById("image-input");
    imageInput.addEventListener("change", function () {
        previewImage();
    });
};

function previewImage() {
    let oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-input").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
    };
};