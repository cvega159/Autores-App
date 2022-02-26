const deleteElement = (id, name, rute) => {
      const form = document.getElementById('form');
      const spans = document.querySelectorAll('.name');

      spans.forEach((span) => {
            span.innerText = name;
      });
      form.action = `https://informatica.ieszaidinvergeles.org:10047/laraveles/autoresApp/public/${rute}/${id}`;
};
