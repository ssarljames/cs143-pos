@extends("app")

@section("page-title", "Product Categories")


@section("page-content")

    <?php /** @var \App\Models\Category $category */ ?>

    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-5">

        <div>
            <a href="{{ route("inventory") }}">
                <i class="fa fa-arrow-left"></i>
                Back to Inventory</a>
        </div>

        <div class="ml-auto">
            <form action="">
                <div class="inner-addon right-addon">
                    <i class="fa fa-search text-warning"></i>
                    <input type="text" name="q" value="{{ request("q") }}" placeholder="Search category..."
                           class="form-control"/>
                </div>
            </form>
        </div>

        <button class="btn btn-primary ml-3 " id="new-category-button">
            <i class="fa fa-plus"></i>
            New Category
        </button>

    </div>



    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Product Count</th>
            <th></th>
        </tr>
        </thead>
        <tbody>


        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>
                    <button data-category-name="{{ $category->name }}"
                            data-category-id="{{ $category->id }}"
                            class="btn btn-outline-default btn-sm edit-button">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No data</td>
            </tr>
        @endforelse
        </tbody>
    </table>


    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set Title Please</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="error-container"></div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Type category name">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-button">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section("scripts")

    <script>
        $(document).ready(function () {

            let selectedCategoryId = null;

            $("#new-category-button").click(function () {

                selectedCategoryId = null;

                $("#categoryModal .modal-title").html("New Category")


                $("#error-container").html("")
                $(`#categoryModal input[name="name"]`).val("");

                $("#categoryModal").modal({
                    backdrop: 'static'
                })
            });


            $(".edit-button").click(function () {

                selectedCategoryId = $(this).data("category-id");

                const name = $(this).data("category-name");

                $(`#categoryModal input[name="name"]`).val(name);

                $("#categoryModal .modal-title").html("Edit Category")

                $("#error-container").html("")

                $("#categoryModal").modal({
                    backdrop: 'static'
                })
            });


            $("#categoryModal .save-button").click(function () {

                const name = $(`#categoryModal input[name="name"]`).val();


                $.ajax({
                    url: selectedCategoryId == null ? "/categories" : `categories/${selectedCategoryId}`,
                    method: selectedCategoryId == null ? "POST" : "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name
                    },
                    success: function (response) {
                        $("#categoryModal").modal("hide");
                        document.location.reload();
                    },
                    error: function (e) {
                        console.log(e.responseJSON.errors)

                        let html = "<div class='alert alert-danger'> Errors <ul>";

                        const errors = e.responseJSON.errors;

                        for (const key in errors) {
                            html += `<li>${errors[key]}</li>`
                        }

                        html += "</li></div>";

                        $("#error-container").html(html);

                    }
                });

            });

        });
    </script>

@endsection
