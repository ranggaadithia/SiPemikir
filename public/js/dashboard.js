const title = document.querySelector("#title");
const slug = document.querySelector("#slug");
title.addEventListener("change", function () {
    fetch("/dashboard/posts/checkSlug?title=" + title.value)
        .then((response) => response.json())
        .then((data) => (slug.value = data.slug));
});

function imagePreview() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-preview");

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
