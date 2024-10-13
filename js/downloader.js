data.forEach(MnY => {
    let link = document.createElement("a"); // Corrected to use 'document' instead of 'new Document()'
    link.textContent = MnY.trim(); // Changed to 'MnY' instead of the string 'MnY'
    let date = new Date()

    let url = `pdf?month=${MnY.slice(0,3)}&dx=${date.getDate()}&dy=${date.getFullYear()}`;
    link.addEventListener("click",()=>{
        window.location.replace(url)
    })
    content.appendChild(link); // Append the link to the content
});

let params = new URLSearchParams(document.location.search);

if(params.get('month') !== null && params.get('dx') != null && params.get('dy') != null)
{
    button.textContent = "Download";
    button.addEventListener("click", function () {
        const chartCanvas = document.getElementById('graph');
    
        // Capture the canvas using html2canvas
        html2canvas(chartCanvas).then(function (canvasElement) {
            const imgData = canvasElement.toDataURL("image/png");
    
            // Create a new jsPDF instance (A4 paper size)
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
    
            // Get the canvas dimensions
            const canvasWidth = canvasElement.width;
            const canvasHeight = canvasElement.height;
    
            // Get PDF page dimensions
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = pdf.internal.pageSize.getHeight();
    
            // Calculate the aspect ratio to scale the image properly
            const aspectRatio = canvasWidth / canvasHeight;
            
            let newCanvasWidth = pdfWidth; // Default to full width of the PDF
            let newCanvasHeight = pdfWidth / aspectRatio; // Adjust height to maintain aspect ratio
    
            // Check if the height exceeds the PDF page height
            if (newCanvasHeight > pdfHeight) {
                newCanvasHeight = pdfHeight;
                newCanvasWidth = pdfHeight * aspectRatio;
            }
    
            // Add the image to the PDF, scaled to fit
            pdf.addImage(imgData, "PNG", 0, 0, newCanvasWidth, newCanvasHeight);
            pdf.text(`${new Date()}`, 0, 0);
            pdf.save(`${new Date()}.pdf`);
            window.location.reload();
        }).catch(function (error) {
            console.error("Error generating PDF:", error);
        });
    });
    
}
