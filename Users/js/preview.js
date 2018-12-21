let input = document.querySelector('input[type="file"]');
let preview = document.querySelector('.preview');

let dataFiles;
input.addEventListener("change", function(){
	while(preview.firstChild) {
		preview.removeChild(preview.firstChild);
	}
	dataFiles = this.files;
	let imgName = document.createElement('p');
	let imgSize = document.createElement('p');
	let image = document.createElement('img');
	image.src = window.URL.createObjectURL(dataFiles[0]);	
	imgName.textContent = dataFiles[0].name;
	imgSize.textContent = convertSize(dataFiles[0].size);
	preview.appendChild(imgName);
	preview.appendChild(imgSize);
	preview.appendChild(image);
});

function convertSize(size){
	let Kb = 0;
	let Mb = 0;
	if(size < 1024)
	{
		return `${size} bites`;
	}
	else if(size > 1024 && size < 1024*1024)
	{
		return `${(size/1024).toFixed(1)} Kb`;
	}
	else if(size > 1024*1024)
	{
		return `${(size/(1024*1024)).toFixed(1)} Mb`;
	}
}