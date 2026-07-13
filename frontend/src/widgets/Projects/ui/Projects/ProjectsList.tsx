import { Cards } from "../index";
import styles from "./ProjectsList.module.scss";
import { Tags } from "../index";
import { ProjectsProvider } from "@/entities/projects/model/ProjectsContext";
import { LoadButton } from "../LoadButton";
import clsx from "clsx";

interface ProjectsListProps {
  showLoadButton?: boolean;
  style?: "home" | "project";
}

export const ProjectsList = ({ showLoadButton = true, style = "project" }: ProjectsListProps) => {
  return (
    <ProjectsProvider>
      <section className={clsx(styles.projects, styles[style])}>
        <div className={styles.title}>Наши проекты</div>
        <Tags />
        <Cards style={style} />
        {showLoadButton && <LoadButton />}
      </section>
    </ProjectsProvider>
  );
};
