export interface ContactsResponse {
  message: string;
  data: ContactResource[];
}

export interface ContactResource {
  kay: string;
  value: string;
}
