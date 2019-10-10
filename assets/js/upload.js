(function() {

    function createThumbnail(file) {

        var reader = new FileReader();

        reader.addEventListener('load', function() {

//            var imgElement = document.createElement('img');
//            imgElement.style.width = '100%';
//            imgElement.style.height = 'auto';
//            imgElement.src = this.result;
            var pic = this.result;
            prev.innerHTML = '<img src="' + pic + '" alt="" id="picture" class="pic2">';

        });

        reader.readAsDataURL(file);

    }

    var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
        fileInput = document.querySelector('#addFile'),
        upload = document.querySelector('#upload'),
        prev = document.querySelector('#prev');

    fileInput.addEventListener('change', function() {

        var files = upload.files,
            filesLen = files.length,
            imgType;

        for (var i = 0; i < filesLen; i++) {

            imgType = files[i].name.split('.');
            imgType = imgType[imgType.length - 1];

            if (allowedTypes.indexOf(imgType) != -1) {
                createThumbnail(files[i]);
            }

        }

    });

})();