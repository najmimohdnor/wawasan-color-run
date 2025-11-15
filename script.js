document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector("body");
    const sidebar = body.querySelector(".sidebar");
    const toggle = body.querySelector(".toggle");
    const searchBtn = body.querySelector(".search-box");
    const modeSwitch = body.querySelector(".toggle-switch");
    const modeText = body.querySelector(".mode-text");
    const navLinks = document.querySelectorAll(".menu-links a");
    const inputs = document.querySelectorAll(".contact-input");
    const fileInput = document.querySelector("input[type='file']");
    const fileNameDisplay = document.querySelector(".file-name");
    const clearButton = document.querySelector(".btn.clear");
    const uploadButton = document.querySelector(".btn.upload");
    const accordionContent = document.querySelectorAll(".accordion-content");
    

    inputs.forEach(ipt => {
        ipt.addEventListener("focus", () => {
            ipt.parentNode.classList.add("focus");
            ipt.parentNode.classList.add("not-empty");
        });
        ipt.addEventListener("blur", () => {
            if(ipt.value == ""){
                ipt.parentNode.classList.remove("not-empty");
            }
            ipt.parentNode.classList.remove("focus");
        });
    });

    fileInput.addEventListener("change", function () {
        const fileName = this.files[0].name;
        fileNameDisplay.textContent = "File: " + fileName;
        clearButton.style.display = "inline-block";
        uploadButton.style.display = "none";
    });
    fileInput.addEventListener("change", function () {
        const selectedFile = this.files[0];
        if (selectedFile) {
            const fileName = selectedFile.name;
            const fileNameWithoutExtension = fileName.split(".")[0];
            const fileExtension = fileName.split(".").pop();
            
        
            const maxLength = 20;
            let displayedFileName = fileNameWithoutExtension.substring(0, maxLength);
            
            
            if (fileNameWithoutExtension.length > maxLength) {
                displayedFileName += "...";
            }
            
            displayedFileName += "." + fileExtension;
            
            fileNameDisplay.textContent = "File: " + displayedFileName;
            clearButton.classList.add("show");
            uploadButton.classList.add("hide");
        }
    });
    accordionContent.forEach((item, index) => {
        let header = item.querySelector("header");
        header.addEventListener("click", () =>{
            item.classList.toggle("open");
    
            let description = item.querySelector(".description");
            if(item.classList.contains("open")){
                description.style.height = `${description.scrollHeight}px`; //scrollHeight property returns the height of an element including padding , but excluding borders, scrollbar or margin
                item.querySelector("i").classList.replace("fa-plus", "fa-minus");
            }else{
                description.style.height = "0px";
                item.querySelector("i").classList.replace("fa-minus", "fa-plus");
            }
            removeOpen(index); //calling the funtion and also passing the index number of the clicked header
        })
    })
    
    function removeOpen(index1){
        accordionContent.forEach((item2, index2) => {
            if(index1 != index2){
                item2.classList.remove("open");
    
                let des = item2.querySelector(".description");
                des.style.height = "0px";
                item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
            }
        })
    } 

    clearButton.addEventListener("click", function () {
        fileInput.value = "";
        fileNameDisplay.textContent = "";
        clearButton.style.display = "none";
        uploadButton.style.display = "inline-block"; 
    });
        

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Dark Mode";
        } else {
            modeText.innerText = "Light Mode";
        }
    });
    function positionTooltip() {
    const tooltips = document.querySelectorAll(".tooltip");

    tooltips.forEach((tooltip) => {
        const link = tooltip.previousElementSibling;
        const linkRect = link.getBoundingClientRect()

        
        tooltip.style.top = linkRect.top + linkRect.height / 2 + "px";
        tooltip.style.left = linkRect.right + 10 + "px";
    });
}
    navLinks.forEach((link) => {
        link.addEventListener("click", (event) => {
            event.preventDefault();
            const targetId = link.getAttribute("href").substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop,
                    behavior: "smooth",
                });
          }
      });
  });
});
function positionTooltips() {
    const tooltips = document.querySelectorAll(".tooltip");

    tooltips.forEach((tooltip) => {
        const link = tooltip.previousElementSibling;
        const linkRect = link.getBoundingClientRect();
        const tooltipWidth = tooltip.offsetWidth;
        const tooltipHeight = tooltip.offsetHeight;
        const topOffset = (linkRect.height - tooltipHeight) / 2;
        const leftOffset = 3;
        
        tooltip.style.top = linkRect.top + topOffset + "px";
        tooltip.style.left = linkRect.right + leftOffset + "px";
    });
}

positionTooltips();
window.addEventListener("resize", positionTooltips);
