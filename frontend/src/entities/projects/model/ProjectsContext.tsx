"use client";

import { createContext, useContext, ReactNode } from "react";
import { useInfiniteProjects } from "../api/projectsApi";
import { ContextError } from "@/shared/lib/errors";
import { Project } from "../api/types";

interface ProjectsContextType {
  projects: Project[];
  loading: boolean;
  hasNextPage: boolean;
  fetchNextPage: () => void;
  isFetchingNextPage: boolean;
  showButton?: boolean;
}

const ProjectsContext = createContext<ProjectsContextType | undefined>(undefined);

export const ProjectsProvider = ({ children }: { children: ReactNode }) => {
  const { data, isLoading, hasNextPage, fetchNextPage, isFetchingNextPage } = useInfiniteProjects();

  const allProjects = data?.pages.flatMap((page) => page.data.items) || [];

  return (
    <ProjectsContext.Provider
      value={{
        projects: allProjects,
        loading: isLoading,
        hasNextPage,
        fetchNextPage,
        isFetchingNextPage,
      }}
    >
      {children}
    </ProjectsContext.Provider>
  );
};

export const useProjectsContext = () => {
  const context = useContext(ProjectsContext);

  if (context === undefined) {
    throw new ContextError("useProjectsContext must be used within ProjectsProvider");
  }

  return context;
};
