function onCreate() {
    document.getElementById('create').style.display = 'block';
    document.getElementById('update').style.display = 'none';
    document.getElementById('delete').style.display = 'none';
}

function onUpdate() {
    document.getElementById('create').style.display = 'none';
    document.getElementById('update').style.display = 'block';
    document.getElementById('delete').style.display = 'none';
}

function onDelete() {
    document.getElementById('create').style.display = 'none';
    document.getElementById('update').style.display = 'none';
    document.getElementById('delete').style.display = 'block';
}

function offAll() {
    document.getElementById('create').style.display = 'none';
    document.getElementById('update').style.display = 'none';
    document.getElementById('delete').style.display = 'none';
}