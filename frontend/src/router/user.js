import UserIndex from '../views/user/Index';
import UserCreate from '../views/user/Create';
import UserEdit from '../views/user/Edit';

const user = [
    {
        path: '/users',
        name: 'users.index',
        component: UserIndex
    },
    {
        path: '/users/create',
        name: 'users.create',
        component: UserCreate
    },
    {
        path: '/users/:id/edit',
        name: 'users.edit',
        component: UserEdit
    }
];

export default user