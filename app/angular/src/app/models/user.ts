export class User {
    id: number;
    username: string;
    firstName: string;
    lastName: string;
    password: string;
    token?: string;
    nickname: string;
    following: Array<any>;
}
