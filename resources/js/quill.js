import Quill from "quill";

const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Write post content here'
});

const postForm = document.getElementById('post-form');
const postBody = document.getElementById('body');
const editor = document.getElementById('editor');

postForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const content = editor.children[0].innerHTML;

    postBody.value = content;

    this.submit();
})
