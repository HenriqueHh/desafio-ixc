<link href="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    new Cleave('.moeda', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
        prefix: 'R$ ',
        numeralDecimalMark: ',',
        delimiter: '.'
    });
});
</script>
