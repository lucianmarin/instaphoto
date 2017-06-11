function picture(element) {
    var label = element.previousElementSibling,
        view = label.previousElementSibling,
        file = element.files[0];
    if (file) {
        view.style.backgroundImage = 'url(' + URL.createObjectURL(file) + ')';
        label.innerHTML = element.value.replace(/.*[\/\\]/, '');
    }
}
