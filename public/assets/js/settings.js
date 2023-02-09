window.onload = function () {
    const profilePicInput = document.getElementById('profile-pic-input');
    profilePicInput.addEventListener('change', function () {
        previewProfilePic(this.files[0]);
    });
    const submitButton = document.getElementById('submit-button');
    submitButton.addEventListener('click', function () {
        handleSubmit();
    });
    const resetButton = document.getElementById('reset-button');
    resetButton.addEventListener('click', function () {
        handleReset();
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

function handleSubmit() {
    const bio = document.getElementById('bio').value;
    const picInput = document.getElementById('profile-pic-input').files[0];
    const closeButton = document.getElementById('close-button');
    closeButton.click();
    if (picInput === undefined) {
        const profilePic = document.getElementById("profile-pic-preview").getAttribute("src");
        axios.post("profileSettings.php", { bio: bio, profilePic: profilePic }).then(Response => {
        });
    } else {
        const profilePic = picInput["name"];
        axios.post("profileSettings.php", { bio: bio, profilePic: profilePic }).then(Response => {
        });
    }
}

function handleReset() {
    axios.get("profileSettings.php").then(Response => {
        const data = Response.data;
        console.log(data);
        const profilePic = document.getElementById("profile-pic-preview");
        profilePic.setAttribute("src", data["nomefile"]);
        const bio = document.getElementById("bio");
        bio.innerText = data["bio"];
    });
}