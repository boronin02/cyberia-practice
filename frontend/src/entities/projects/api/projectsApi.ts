export interface ProjectResponse {
  message: "string";
  data: {
    pagination: {
      page: "string";
      per_page: "string";
      last_page: "string";
      total: "string";
    };
    items: [];
  };
}

export interface Project {
  id: number;
  title: string;
  description: string;
  image: {
    original_url: string;
    preview_url: string;
  };
}

export const fetchProjects = async (pageNum: number): Promise<ProjectResponse> => {
  const response = await fetch(`/api/projects?page=${pageNum}`);
  return response.json();
};
