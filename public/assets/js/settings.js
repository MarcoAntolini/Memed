window.onload = function () {
    const profilePicInput = document.getElementById('profile-pic-input');
    profilePicInput.addEventListener('change', function () {
        previewProfilePic(this.files[0]);
    });
};

function previewProfilePic(file) {
    const validImageTypes = ["image/jpg", "image/jpeg", "image/png"];
    if (file && validImageTypes.includes(file.type)) {
        const oFReader = new FileReader();
        oFReader.readAsDataURL(file);
        oFReader.onload = function (oFREvent) {
            const profilePicPreview = document.getElementById('profile-pic-preview');
            profilePicPreview.setAttribute("src", oFREvent.target.result);
        };
    }
}

// TODO: chiamata al php al submit del form, pensare cosa fare per il reset

axios.get("settingsPic.php").then(Response => {
    console.log(Response.data);
    const data = Response.data;
    const bio = document.getElementById("bio");
    bio.innerText = data["bio"];
    const profilePic = document.getElementById("profile-pic-preview");
    profilePic.setAttribute("src", data);
});