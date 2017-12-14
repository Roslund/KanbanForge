@extends('layouts.app')

@section('head')

    <title>Sign In</title>

@endsection

@section('content')


<body class="signup">

    <div id="welcome-page" style="padding: 90px;">
        <div class="container">
            <div class="row">
            <hr>
                <h2>KANBAN BOARD</h2>

                <div class="container-fluid">
        <div id="sortableKanbanBoards" class="row">

            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    TODO
                    <i class="fa fa-2x fa-plus-circle pull-right"></i>
                </div>
                <div class="panel-body">
                    <div id="TODO" class="kanban-centered">

                        <article class="kanban-entry grab" id="item1" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Everything</a> <span>has to be done</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry grab" id="item2" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Job Meeting</a></h2>
                                    <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry grab" id="item3" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Random person</a> <span>taughts on Vasteras</span> </h2>

                                    <blockquote>Great place, feeling like in home.</blockquote>


                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry grab" id="item4" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Random person</a> <span>changed his</span> <a href="#">Profile Picture</a></h2>

                                    <blockquote>Pianoforte principles our unaffected not for astonished travelling are particular.</blockquote>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#">Add a card...</a>
                </div>
            </div>

            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    DOING
                    <i class="fa fa-2x fa-plus-circle pull-right"></i>
                </div>
                <div class="panel-body">
                    <div id="DOING" class="kanban-centered">

                        <article class="kanban-entry grab" id="item5" draggable="true">
                            <div class="kanban-entry-inner">

                                <div class="kanban-label">
                                    <h2><a href="#">Random person</a> <span>posted a status update</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry grab" id="item6" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Job Meeting</a></h2>
                                    <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#">Add a card...</a>
                </div>
            </div>

            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    DONE
                    <i class="fa fa-2x fa-plus-circle pull-right"></i>
                </div>
                <div class="panel-body">
                    <div id="DONE" class="kanban-centered">

                        <article class="kanban-entry grab" id="item5" draggable="true">
                            <div class="kanban-entry-inner">

                                <div class="kanban-label">
                                    <h2><a href="#">Random person</a> <span>posted a status update</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>

                        <article class="kanban-entry grab" id="item6" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Job Meeting</a></h2>
                                    <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#">Add a card...</a>
                </div>
            </div>


        </div>
    </div>


    <!-- Static Modal -->
    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-refresh fa-5x fa-spin"></i>
                        <h4>Processing...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

</body>

@endsection
