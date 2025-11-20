CKEDITOR.replace('ckDescription', {
    height: 300,
});

CKEDITOR.instances.ckDescription.on('change', function () {
    const html = CKEDITOR.instances.ckDescription.getData();
    document.getElementById('contentPreview').innerHTML = renderWithFakeTokens(html);
});

function renderWithFakeTokens(html) {
    for (const key in tokenMapping) {
        const value = tokenMapping[key];
        const regex = new RegExp(`{${key}}`, 'g');
        html = html.replace(regex, value);
    }
    return html;
}

window.onload = function () {
    const html = CKEDITOR.instances.ckDescription.getData();
    document.getElementById('contentPreview').innerHTML = renderWithFakeTokens(html);
};
