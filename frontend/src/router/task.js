import TaskIndex from '../views/task/Index';
import TaskCreate from '../views/task/Create';
import TaskUpdate from '../views/task/Edit';

const task = [
    {
        path: '/tasks',
        name: 'tasks.index',
        component: TaskIndex
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: TaskCreate
    },
    {
        path: '/tasks/:id/edit',
        name: 'tasks.edit',
        component: TaskUpdate
    }
];

export default task