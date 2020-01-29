function genPDF(){
  var doc = new jsPDF();
  doc.fromHTML('#mostrarpdf')get(0),20,20,{
    'width':500 });
    doc.save('parte.pdf');
  }
