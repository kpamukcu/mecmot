</div>
</div>
</div>
</section>
<!-- Panel Section End -->

<!-- Js Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.editor').forEach((textarea) => {
        ClassicEditor
            .create(textarea)
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script src="../assets/js/main.js"></script>


</body>

</html>