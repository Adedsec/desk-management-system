<div class="row mt-3 vh-84">
    <ul class="d-flex align-items-start  flex-nowrap overflow-scroll flex-row" wire:sortable="updateListOrder"
        wire:sortable-group="updateTaskOrder">
        {{--        lists--}}
        <livewire:project.task-list :project="$project" :list="null" :key="'task-list'.'0'.rand()"/>
        @foreach($project->lists->sortBy('order') as $list)
            <livewire:project.task-list :project="$project" :list="$list"
                                        :key="'task-list-'.$list->order.rand()"/>
        @endforeach
        {{--        add list button--}}

        @can('manage_lists')
            <a href="#" data-bs-toggle="modal" data-bs-target="#createListModal" class="text-decoration-none col-md-2"
               style="width: 20%">
                <div class="rounded-2  mb-1 d-flex justify-content-center  align-items-center"
                     style="height: 32px; background-color: #d0cfcf">
                    <div class="m-3">
                        <div class="text-secondary">ایجاد لیست</div>
                    </div>
                </div>
            </a>
        @endcan
    </ul>


    <!-- Modal -->
    @can('manage_lists')
        <div class="modal fade" id="createListModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">افزودن لیست جدید</h5>
                    </div>
                    <div class="modal-body">
                        <livewire:project.create-list-form :project="$project"/>
                    </div>

                </div>
            </div>
        </div>

    @endcan

    <script>

    </script>
</div>
