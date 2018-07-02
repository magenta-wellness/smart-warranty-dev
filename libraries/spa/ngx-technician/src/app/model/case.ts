import { Warranty } from "./warranty";
import { Registration } from "./registration";
import { Product } from "./product";

export class Case {
    _id: string;
    id: number;
    children: Case[];
    warranty: Warranty;
    serviceZone: {};
    createdAt: Date;
    appointmentAt: Date;
    completed: boolean;
    status: string;
    number: string;
    description: string;
}