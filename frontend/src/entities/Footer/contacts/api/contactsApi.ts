export interface ContactsResponse {
  message: string;
  data: Contact[];
}

export interface Contact {
  kay: string;
  value: string;
}

export const fetchContacts = async (): Promise<ContactsResponse> => {
  const response = await fetch("/api/contacts");
  return response.json();
};
