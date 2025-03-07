<!-- resources/views/filament/resources/workflow-resource/pages/create-workflow.blade.php -->
<div>
    <div id="toolbar" style="margin-bottom: 10px;">
        <button onclick="addElement('Start')">Start</button>
        <button onclick="addElement('Task')">Task</button>
        <button onclick="addElement('Decision')">Decision</button>
        <button onclick="addElement('End')">End</button>
        <button onclick="addElement('Project')">Project</button>
        <button onclick="addElement('Organization')">Organization</button>
        <button onclick="addElement('Company')">Company</button>
        <button onclick="addElement('Department')">Department</button>
        <button onclick="addElement('Activity')">Activity</button>
        <button onclick="addElement('Call')">Call</button>
        <button onclick="addElement('Channel')">Channel</button>
        <button onclick="addElement('Form')">Form</button>
        <button onclick="addElement('Visit')">Visit</button>
        <button onclick="enableConnectionMode()">Connect Elements</button>
    </div>
    <div id="{{ $chartContainerId }}" style="width: 100%; height: 600px; border: 1px solid #ccc;"></div>

    <script src="https://cdn.jsdelivr.net/npm/jsplumb@2.15.6/dist/js/jsplumb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/jsplumb@2.15.6/css/jsplumbtoolkit-defaults.min.css" rel="stylesheet">

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const instance = jsPlumb.getInstance({
                container: document.getElementById('{{ $chartContainerId }}')
            });

            let connectionMode = false;
            let sourceElement = null;

            window.addElement = function (type) {
                const element = document.createElement('div');
                element.className = 'workflow-element';
                element.style.position = 'absolute';
                element.style.left = '50px';
                element.style.top = '50px';
                element.style.width = '100px';
                element.style.height = '50px';
                element.style.backgroundColor = '#f0f0f0';
                element.style.border = '1px solid #ccc';
                element.style.textAlign = 'center';
                element.style.lineHeight = '50px';
                element.innerText = type;

                const container = document.getElementById('{{ $chartContainerId }}');
                container.appendChild(element);

                instance.draggable(element);

                element.addEventListener('click', function (event) {
                    event.stopPropagation();
                    if (connectionMode) {
                        if (sourceElement) {
                            instance.connect({
                                source: sourceElement,
                                target: element,
                                anchors: ['Right', 'Left'],
                                endpoint: 'Dot',
                                connector: ['Straight'],
                                paintStyle: { stroke: '#456', strokeWidth: 2 }
                            });
                            sourceElement = null;
                            connectionMode = false;
                        } else {
                            sourceElement = element;
                        }
                    }
                });
            };

            window.enableConnectionMode = function () {
                connectionMode = true;
                alert('Click on the source element first, then the target element to connect them.');
            };
        });
    </script>
</div>