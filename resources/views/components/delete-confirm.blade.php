<div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title">
                    ⚠️ Confirm Delete
                </h5>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                <p>
                    Are you sure you want to delete this item or post?
                </p>

                <small class="text-muted">
                    This action cannot be undone.
                </small>

            </div>


            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>


                <form id="deleteForm" method="POST">

                    @csrf
                    @method('DELETE')


                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>

                </form>

            </div>


        </div>

    </div>

</div>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {

            let button = event.relatedTarget;

            let url = button.getAttribute('data-url');

            document
                .getElementById('deleteForm')
                .setAttribute('action', url);

        });

    });

</script>